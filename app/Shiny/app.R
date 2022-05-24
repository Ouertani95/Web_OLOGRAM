
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
source("data_prep_functions.R")

#--------------------------------------------------------------
# Load shell files
#--------------------------------------------------------------
user_barplot_table <- loading_and_preparing_ologram_table_barplot("shell_file.tsv")
user_volcano_table <- loading_and_preparing_ologram_table_volcano("shell_file.tsv")

#--------------------------------------------------------------
# List available ggplot themes
#--------------------------------------------------------------

themes_avail <- c(grep("^theme_", 
                       ls("package:ggplot2"), 
                       val=TRUE), 
                  grep("^theme_", 
                       ls("package:ggthemes"), 
                       val=TRUE))

themes_avail <- themes_avail[-grep("^theme_get$", themes_avail)]


#--------------------------------------------------------------
# Define UI 
#--------------------------------------------------------------


ui <- fluidPage(
  
  theme = shinytheme("yeti"),
  # App title ----
  titlePanel("Web-OLOGRAM"),
  
  
  # Sidebar layout with input and output definitions ----
  sidebarLayout(
    
    # Sidebar panel for inputs ----
    sidebarPanel(
      checkboxInput("barplot_coordflip_input", "Flip Coordinates", value = FALSE, width = NULL),
      br(),
      # Input: Dopdown for Satistics to use ----
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
    ),
    # Main panel for displaying outputs ----
    mainPanel(
      
      # Output: Tabset w/ plot, summary, and table ----
      tabsetPanel(type = "tabs",
                  tabPanel("Barplot", 
                           br(),
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
                           br(),
                           plotlyOutput("barplot"),
                  ),
                  tabPanel("Volcano Plot", 
                           br(),
                           # Input: Dopdown for Satistics to use ----
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
                           ),
                           conditionalPanel("input.volcanoplot_reactivity_input == 'Reactive'", plotlyOutput("volcano_plotly")),
                           br(),
                           conditionalPanel("input.volcanoplot_reactivity_input == 'Static'", plotOutput("volcano_plot")),
                  ),
                  tabPanel("Table", 
                           tableOutput("table")
                  )
      )
      
    )
  )
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
    updateQueryString("/results")
    if (!is.null(query[['file']])) {
      query[['file']]
      user_barplot_table <- loading_and_preparing_ologram_table_barplot(query[['file']])
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
        coord_fliped +
        my_theme
      
      barly <- ggplotly(bar)
      barly
    }
  })

  volcano_plot <- reactive({
    user_volcano_table <- prepare_volcanoplot()
    if (!is.null(user_volcano_table)) {
      
      if(input$volcano_statistic_input != 'Both')
        user_volcano_table <- user_volcano_table[user_volcano_table$Statistic == input$volcano_statistic_input, ]
      
      if(input$barplot_coordflip_input)
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
        my_theme
      
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
  output$table <- renderTable({
    if (!is.null(user_barplot_table)) {
      user_barplot_table <- prepare_barplot()
      user_barplot_table
    }
  })
  
}

shinyApp(ui, server,options = list("port"=7775,"host"='0.0.0.0'))

