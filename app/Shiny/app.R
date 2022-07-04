
#--------------------------------------------------------------
# Load libraries
#--------------------------------------------------------------

library(shiny)
library(reshape2)
library(ggplot2)
library(dplyr)
library(ggrepel)
library(ggthemes)
library(shinythemes)
library(optparse)
library(plotly)
library(DT)
library(shinydashboard)
library(shinyWidgets)
# library(shinydashboardPlus)
source("data_prep_functions.R")

#--------------------------------------------------------------
# Load shell files
#--------------------------------------------------------------
user_barplot_table <- loading_and_preparing_ologram_table_barplot("shell_file.tsv")
user_volcano_table <- loading_and_preparing_ologram_table_volcano("shell_file.tsv")

#--------------------------------------------------------------
# List available ggplot themes
#--------------------------------------------------------------

themes_avail <- loading_available_themes()

#--------------------------------------------------------------
# Define UI 
#--------------------------------------------------------------


ui <- dashboardPage(skin = "black",
      dashboardHeader(title = "Web_OLOGRAM"),
      dashboardSidebar(
                      sidebarMenu(
                        menuItem("Bar plot", tabName = "Barplot"),
                        menuItem("Volcano plot", tabName = "Volcanoplot"),
                        menuItem("table", tabName = "Table")
                      )
        ),
      dashboardBody(
          tabItems(
            tabItem("Barplot",
              fluidRow(
                box(
                      width = 3, status = "info",
                      title = "Barplot Input",
                      # switchInput(inputId = "barplot_coordflip_input",label="Flip Coordinates", value = FALSE,width = NULL),
                      materialSwitch(inputId = "barplot_coordflip_input", label = "Flip Coordinates", status = "primary", value = FALSE, width = NULL,right=TRUE),
                      # checkboxInput("barplot_coordflip_input", "Flip Coordinates", value = FALSE, width = NULL),
                      # Input: Dopdown for Satistics to use ----
                      materialSwitch(inputId = "barplot_show_pvalue_input", label = "Show P-value", status = "primary", value = FALSE, width = NULL,right=TRUE),
                      # checkboxInput("barplot_show_pvalue_input", "Show P-value", value = FALSE, width = NULL),
                      selectInput(
                        inputId="theme_input", 
                        label="Theme",
                        choices=themes_avail,
                        selected = NULL,
                        multiple = FALSE,
                        selectize = TRUE,
                        width = NULL,
                        size = NULL
                      ),
                      # br(),
                      # Input: Dopdown for Satistics to use ----
                      selectInput(
                        inputId="barplot_statistic_input", 
                        label="Statistics",
                        choices=sort(unique(user_barplot_table$Statistic)),
                        selected = NULL,
                        multiple = FALSE,
                        selectize = TRUE,
                        width = NULL,
                        size = NULL
                      ),
                      pickerInput(
                        inputId = "barplot_features_input", 
                        label = "Features", 
                        choices = sort(unique(user_barplot_table$Feature)), 
                        options = list(
                          `actions-box` = TRUE, 
                          size = 10,
                          `selected-text-format` = "count > 3"
                        ), 
                        multiple = TRUE
                      )
                  ),
                box(
                    width = 9, status = "info", solidHeader = TRUE,
                    title = "Barplot Graph",
                    plotlyOutput("barplot")
                  )
              )
            ),
            tabItem("Volcanoplot",
              fluidRow(
                box(
                      width = 3, status = "info",
                      title = "Volcanoplot Input",
                      # br(),
                      # Input: Dopdown for Satistics to use ----
                      materialSwitch(inputId = "volcanoplot_coordflip_input", label = "Flip Coordinates", status = "primary", value = FALSE, width = NULL,right=TRUE),
                      # checkboxInput("volcanoplot_coordflip_input", "Flip Coordinates", value = FALSE, width = NULL),
                      selectInput(
                        inputId="volcano_statistic_input", 
                        label="Statistics",
                        choices=c("Both", sort(unique(user_volcano_table$Statistic))),
                        selected = NULL,
                        multiple = FALSE,
                        selectize = TRUE,
                        width = NULL,
                        size = NULL
                      ),
                      selectInput(
                        inputId="volcanoplot_reactivity_input", 
                        label="Reactivity",
                        choices=c("Reactive","Static"),
                        selected = "Reactive"
                      )
                  ),
                box(
                    width = 9, status = "info", solidHeader = TRUE,
                    title = "Volcanoplot Graph",
                    conditionalPanel("input.volcanoplot_reactivity_input == 'Reactive'", plotlyOutput("volcano_plotly")),
                    conditionalPanel("input.volcanoplot_reactivity_input == 'Static'", plotOutput("volcano_plot"))
                  )
              )
            ),
            tabItem("Table",
              fluidRow(
                box(width = 12,
                    DT::dataTableOutput("table")
                  )
              )
            )
          )
      ),

)


#--------------------------------------------------------------
# Define server logic 
#--------------------------------------------------------------

server <- function(input, output,session) {
  
  
  # Reactive expression to generate the requested distribution ----
  # This is called whenever the inputs change. The output functions
  # defined below then use the value computed from this expression
  prepare_barplot <- reactive({
    query <- parseQueryString(session$clientData$url_search)
    if (!is.null(query[['file']])) {
      query[['file']]
      user_barplot_table <- loading_and_preparing_ologram_table_barplot(query[['file']])
      updatePickerInput(session, "barplot_features_input",
                        choices=sort(unique(user_barplot_table$Feature)),
                        selected=sort(unique(user_barplot_table$Feature))
      )
      
      user_barplot_table
    }
  })
  
  prepare_volcanoplot <- reactive({
    query <- parseQueryString(session$clientData$url_search)
    if (!is.null(query[['file']])) {
      query[['file']]
      user_volcano_table <- loading_and_preparing_ologram_table_volcano(query[['file']])
      user_volcano_table
    }
  })
  
  
  # Generate a plot of the data ----
  # Also uses the inputs to build the plot label. Note that the
  # dependencies on the inputs and the data reactive expression are
  # both tracked, and all expressions are called in the sequence
  # implied by the dependency graph.
  
  output$barplot <- renderPlotly({
    user_barplot_table <- prepare_barplot()
    if (!is.null(user_barplot_table)) {
      user_barplot_table <- user_barplot_table[user_barplot_table$Statistic == input$barplot_statistic_input,]
      user_barplot_table <- user_barplot_table[user_barplot_table$Feature %in% input$barplot_features_input,]
      
      if(input$barplot_coordflip_input)
        coord_fliped <- coord_flip()
      else
        coord_fliped <- NULL
      
      if(!is.null(input$theme_input))
        my_theme <- do.call(input$theme_input,list(base_size = 11))
      else
        my_theme <- do.call('theme_bw',list(base_size = 11))
      
      bar <- ggplot(user_barplot_table, mapping=aes(x=Feature, y=Value, fill=Type)) + 
        geom_bar(stat="identity", position = "dodge") +
        # geom_text(data = user_barplot_table[user_barplot_table$Type =="True",],aes(y=Pval+Value,label = paste("Pval = ",Pval)),vjust = 1,size=2) +
        # annotate("text",size=3, x = user_barplot_table[user_barplot_table$Type =="True",]$Feature, y = user_barplot_table[user_barplot_table$Type =="True",]$Value, label = paste(user_barplot_table[user_barplot_table$Type =="True",]$Pval))+
        coord_fliped +
        my_theme + 
        theme (axis.text.x = element_text(angle = 45))

      if(input$barplot_show_pvalue_input)
        bar <- bar + annotate("text",size=3, x = user_barplot_table[user_barplot_table$Type =="True",]$Feature, y = user_barplot_table[user_barplot_table$Type =="True",]$Value, label = paste(user_barplot_table[user_barplot_table$Type =="True",]$Pval))
      else
        bar <- bar
      
      barly <- ggplotly(bar)
      barly
    }
  })
  
  volcano_plot <- reactive({
    user_volcano_table <- prepare_volcanoplot()
    if (!is.null(user_volcano_table)) {
      
      if(input$volcano_statistic_input != 'Both')
        user_volcano_table <- user_volcano_table[user_volcano_table$Statistic == input$volcano_statistic_input, ]
      
      if(input$volcanoplot_coordflip_input)
        coord_fliped <- coord_flip()
      else
        coord_fliped <- NULL
      
      if(!is.null(input$theme_input))
        my_theme <- do.call(input$theme_input,list(base_size = 11))
      else
        my_theme <- do.call('theme_bw',list(base_size = 11))
      
      volcano <- ggplot(user_volcano_table, 
                        mapping=aes(x=.data[['log2(FC)']], 
                                    y=.data[['-log10(pvalue)']], 
                                    color=.data[['Statistic']],
                                    label=.data[['Feature']])) + 
        geom_vline(xintercept = 0, 
                   size=0.5) +
        geom_hline(yintercept = 0, 
                   size=0.5) +
        geom_point() +
        
        coord_fliped +
        my_theme +
        theme (axis.text.x = element_text(angle = 45))
      
      if (input$volcanoplot_reactivity_input == "Reactive"){
        volcano <- ggplotly(volcano)
        volcano
      }
      else{
        volcano <- volcano + geom_label_repel(box.padding = 0.5)
        volcano
        volcano
      }
    }
  })
  
  output$volcano_plot <- renderPlot({volcano_plot()})
  
  output$volcano_plotly <- renderPlotly({volcano_plot()})
  
  
  # Generate a summary of the data ----
  output$summary <- renderPrint({
    user_barplot_table <- prepare_barplot()
    if (!is.null(user_barplot_table)) {
      summary(user_barplot_table)
    }
  })
  
  # Generate an HTML table view of the data ----
  output$table <- DT::renderDataTable({
    DT::datatable(prepare_barplot(),rownames = FALSE, class = 'cell-border stripe',extensions = 'Buttons', options = list(
      dom = 'Bfrtip',
      buttons = 
        list('colvis','copy', 'print', list(
          extend = 'collection',
          buttons = c('csv', 'excel', 'pdf'),
          text = 'Download'
        )),
      lengthMenu = list(c( -1,10,30, 50), 
                        c('All','10', '30', '50')),
      paging = T)
      
      
    )
  })
  
}

shinyApp(ui, server,options = list("port"=7775,"host"='0.0.0.0'))

