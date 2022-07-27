
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
library(shinydashboardPlus)
source("data_prep_functions.R")
library(colourpicker)

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


ui <- dashboardPage(skin = "red",
      dashboardHeader(title = "Web_OLOGRAM results", titleWidth = 250),
      dashboardSidebar(
                      width=250,
                      sidebarMenu(
                        menuItem("Bar plot", tabName = "Barplot",icon=icon("chart-bar")),
                        menuItem("Volcano plot", tabName = "Volcanoplot",icon=icon("chart-area")),
                        menuItem("Results table", tabName = "Table",icon=icon("table"))
                      )
        ),
      dashboardBody(
          tags$head(tags$style(HTML('
                                    .main-header .logo {
                                      font-family: "Noto Sans", Times, "Times New Roman", serif;
                                      font-size: 24px;
                                    }
                                    .skin-red .main-header .navbar {background-color: #222d32}
                                    .skin-red .main-header .logo {
                                                                    background-color: #222d32;
                                                                    color: white;
                                                                    border-bottom: solid;
                                                                    border-color: white}
                                    .skin-red .main-header .navbar .sidebar-toggle {color: white}
                                    .skin-red .main-sidebar {border: solid; border-color: white}
                                    .direct-chat-contacts {padding: 20px 25px 20px 20px}
                                    .plotly{height:70vh;}
                                    .box{height: auto;}
                                  '))),
          tabItems(
            tabItem("Barplot",
              fluidRow(
                box(  solidHeader = TRUE,
                      width = 12, status = "warning",
                      title = "Barplot Graph",
                      actionButton("update_bar", "Modify barplot",class = ""),
                      sidebar = boxSidebar(
                        id = "barplot_sidebar",
                        width = 30,
                        h4("Show / Hide",icon("info-circle")),
                        br(),
                        materialSwitch(inputId = "barplot_hide_pvalue_input", label = "Hide P-value", status = "primary", value = FALSE, width = NULL,right=TRUE),
                        materialSwitch(inputId = "barplot_show_fit_input", label = "Show Negative Binomial fit", status = "primary", value = FALSE, width = NULL,right=TRUE),
                        selectInput(inputId="barplot_reactivity_input",label="Reactivity",choices=c("Reactive","Static"),selected = "Reactive"), 
                        selectInput(inputId="barplot_statistic_input",label="Statistics",choices=sort(unique(user_barplot_table$Statistic)),selected = NULL,multiple = FALSE,selectize = TRUE,width = NULL,size = NULL),
                        pickerInput(inputId = "barplot_features_input", label = "Features",choices = sort(unique(user_barplot_table$Feature)), options = list(`actions-box` = TRUE, size = 10,`selected-text-format` = "count > 3"), multiple = TRUE),
                        br(),
                        h4("Title and labels"),
                        br(),
                        materialSwitch(inputId = "barplot_coordflip_input", label = "Flip Coordinates", status = "primary", value = FALSE, width = NULL,right=TRUE),
                        textInput("Barx", "X axis label", "Feature"),
                        numericInput("Barxangle", "X axis values angle", 45, min = 0, max = 90),
                        textInput("Bary", "Y axis label", "Value"),
                        textInput("Bartitle", "Barplot title",NULL),
                        br(),
                        h4("Theming"),
                        br(),    
                        selectInput(inputId="bar_theme_input", label="Theme",choices=themes_avail,selected = NULL,multiple = FALSE,selectize = TRUE,width = NULL,size = NULL),
                        colourInput("colShuff", "Shuffled colour", "#FF7B00"),
                        colourInput("colTrue", "True colour", "#00CCFF")
                      ), 
                      conditionalPanel("input.barplot_reactivity_input == 'Reactive'", plotlyOutput("bar_plotly",height = "70vh")),
                      conditionalPanel("input.barplot_reactivity_input == 'Static'", plotOutput("bar_plot",height = "70vh")),
                      conditionalPanel("input.barplot_reactivity_input == 'Static'", downloadButton("downloadBar", "Download barplot"))
                  )
              )
            ),
            tabItem("Volcanoplot",
              fluidRow(
                box(  solidHeader = TRUE,
                      width = 12, status = "warning",
                      title = "Volcanoplot Graph",
                      actionButton("update_volcano", "Modify volcanoplot"),
                      sidebar = boxSidebar(title = "Volcanoplot input",
                        id = "volcanoplot_sidebar",
                        width = 30,
                        h4("Show / Hide"),
                        
                        br(),
                        selectInput(inputId="volcano_statistic_input",label="Statistics",choices=c("Both", sort(unique(user_volcano_table$Statistic))),selected = NULL,multiple = FALSE,selectize = TRUE,width = NULL,size = NULL),
                        selectInput(inputId="volcanoplot_reactivity_input",label="Reactivity",choices=c("Reactive","Static"),selected = "Reactive"), 
                        br(),
                        h4("Title and labels"),
                        br(),
                        materialSwitch(inputId = "volcanoplot_coordflip_input",label = "Flip Coordinates",status = "primary",value = FALSE,width = NULL,right=TRUE),
                        textInput("Volcanox", "X axis label", value="log2(FC)"),
                        textInput("Volcanoy", "Y axis label", value="-log10(pvalue)"),
                        textInput("Volcanotitle", "Volcanoplot title",value=""),
                        br(),
                        br(),
                        h4("Theming"),
                        br(),
                        selectInput(inputId="volcano_theme_input", label="Theme",choices=themes_avail,selected = NULL,multiple = FALSE,selectize = TRUE,width = NULL,size = NULL),
                        colourInput("col_N", "Number of intersections colour", "#FF7B00"),
                        colourInput("col_S", "Overlap length colour", "#00CCFF")
                             
                      ),
                      conditionalPanel("input.volcanoplot_reactivity_input == 'Reactive'", plotlyOutput("volcano_plotly",height = "70vh")),
                      conditionalPanel("input.volcanoplot_reactivity_input == 'Static'", plotOutput("volcano_plot",height = "70vh")),
                      conditionalPanel("input.volcanoplot_reactivity_input == 'Static'", downloadButton("downloadVolcano", "Download volcanoplot"))
                      
                      
                  ),
              )
            ),
            tabItem("Table",
              fluidRow(
                box(width = 12,
                    solidHeader = TRUE,
                    status = "info",
                    title = "Results Table",
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
  prepare_barplot_table <- reactive({
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
  
  prepare_volcanoplot_table <- reactive({
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

  prepare_barplot <- reactive({
    user_barplot_table <- prepare_barplot_table()
    if (!is.null(user_barplot_table)) {
      user_barplot_table <- user_barplot_table[user_barplot_table$Statistic == input$barplot_statistic_input,]
      user_barplot_table <- user_barplot_table[user_barplot_table$Feature %in% input$barplot_features_input,]
      
      if(input$barplot_coordflip_input)
        coord_fliped <- coord_flip()
      else
        coord_fliped <- NULL
      
      if(!is.null(input$bar_theme_input))
        my_theme <- do.call(input$bar_theme_input,list(base_size = 11))
      else
        my_theme <- do.call('theme_bw',list(base_size = 11))

      if (input$barplot_statistic_input == 'Total overlap length per region type'){
          abr <- " (S)"
        }
        else{
          abr <- " (N)"
        }
      
      bar <- ggplot(user_barplot_table, mapping=aes(x=Feature, y=Value, fill=Type)) + 
        geom_bar(stat="identity", position = "dodge") +
        scale_fill_manual(values=c(input$colShuff,input$colTrue))+
        coord_fliped +
        my_theme + 
        theme (axis.text.x = element_text(angle = input$Barxangle),plot.title=element_text(hjust=0.5))+
        ggtitle(paste(input$barplot_statistic_input,abr))

      if (!is.null(input$Barx)) {
        bar <- bar + xlab(input$Barx)
      }
      
      if (!is.null(input$Bary)) {
        bar <- bar + ylab(input$Bary)
      }

      if (input$Bartitle != "") {
        bar <- bar + ggtitle(input$Bartitle)
      }

      if(!input$barplot_hide_pvalue_input){
        bar <- bar + geom_text(data = user_barplot_table[user_barplot_table$Type =="True",], aes(x = Feature, y = Value+0.1 * max(Value), label = paste(Pval)),size=3)
      }

      if(input$barplot_show_fit_input){
         
        bar <- bar + geom_text(data = user_barplot_table[user_barplot_table$Type =="True",], aes(x = Feature, y = Value+0.25 * max(Value), label = paste(Neg_binom_fit)),size=3,color="blue")
      }
      else
        bar <- bar
      bar
    }
  })
  
  output$bar_plot <- renderPlot({prepare_barplot()})

  output$bar_plotly <- renderPlotly({
    bar <- prepare_barplot()
    bar <- ggplotly(bar)
    bar <- bar %>% config(bar, displayModeBar = TRUE) 
    bar
    })

  prepare_volcanoplot <- reactive ({
    user_volcano_table <- prepare_volcanoplot_table()
    if (!is.null(user_volcano_table)) {
      
      if(input$volcano_statistic_input != 'Both')
        user_volcano_table <- user_volcano_table[user_volcano_table$Statistic == input$volcano_statistic_input, ]
      
      if(input$volcanoplot_coordflip_input)
        coord_fliped <- coord_flip()
      else
        coord_fliped <- NULL
      
      if(!is.null(input$volcano_theme_input))
        my_theme <- do.call(input$volcano_theme_input,list(base_size = 11))
      else
        my_theme <- do.call('theme_bw',list(base_size = 11))
      
      volcano <- ggplot(user_volcano_table, 
                        mapping=aes(x=.data[['log2(FC)']], 
                                    y=.data[['-log10(pvalue)']], 
                                    color=.data[['Statistic']],
                                    label=.data[['Feature']])) + 
        scale_color_manual(values=c(input$col_N,input$col_S))+
        geom_vline(xintercept = 0, 
                   size=0.5) +
        geom_hline(yintercept = 0, 
                   size=0.5) +
        geom_point() +
        
        coord_fliped +
        my_theme +
        theme (plot.title=element_text(hjust=0.5))
      
      if (!is.null(input$Volcanox)) {
        volcano <- volcano + xlab(input$Volcanox)
      }
      
      if (!is.null(input$Volcanoy)) {
        volcano <- volcano + ylab(input$Volcanoy)
      }

      if (input$Volcanotitle !=  "") {
        volcano <- volcano + ggtitle(input$Volcanotitle)
      }

      if (input$volcanoplot_reactivity_input == "Reactive"){
        volcano <- ggplotly(volcano)
        volcano
      }
      else{
        volcano <- volcano + geom_label_repel(box.padding = 0.5)
        volcano
      }
    }

  })
  
  
  output$volcano_plot <- renderPlot({prepare_volcanoplot()})
  
  output$volcano_plotly <- renderPlotly({
    
    volcano <- prepare_volcanoplot()
    volcano <- ggplotly(volcano)
    volcano <- volcano %>% config(volcano, displayModeBar = TRUE)
    
    })

  
  # Generate an HTML table view of the data ----
  output$table <- DT::renderDataTable({
    DT::datatable(prepare_barplot_table(),rownames = FALSE, class = 'cell-border stripe',extensions = 'Buttons', options = list(
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
  
   output$downloadBar <- downloadHandler(
    filename = function() {
      timestamp <- format(Sys.time(), "%Y-%m-%d_%H-%M-%S")
      paste("Barplot-", timestamp, ".png", sep="")
    },
    content = function(file) {
      ggsave(file,prepare_barplot(), width = 16, height = 10.4)
    }
  )

  output$downloadVolcano <- downloadHandler(
    filename = function() {
      timestamp <- format(Sys.time(), "%Y-%m-%d_%H-%M-%S")
      paste("Volcanoplot-", timestamp , ".png", sep="")
    },
    content = function(file) {
      ggsave(file,prepare_volcanoplot(), width = 16, height = 10.4)
    }
  )

  observeEvent(input$update_bar, {
      updateBoxSidebar("barplot_sidebar")
    })

  observeEvent(input$update_volcano, {
      updateBoxSidebar("volcanoplot_sidebar")
    })

}

shinyApp(ui, server,options = list("port"=7775,"host"='0.0.0.0'))

