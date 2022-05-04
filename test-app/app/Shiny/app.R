
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

#--------------------------------------------------------------
# Argument Parser
#--------------------------------------------------------------

option_list = list(
  make_option(c("-i", "--inputfile"), 
              type="character", 
              default=NULL, 
              help="Path to the csv file produced by OLOGRAM(-MODL).", 
              metavar="INPUTFILE")
  )


opt_parser = OptionParser(option_list=option_list);
opt = parse_args(opt_parser);

if (is.null(opt$inputfile)){
  stop("Path to the csv file produced by OLOGRAM(-MODL) is mandatory (--inputfile)", call.=FALSE)
}



#--------------------------------------------------------------
# Argument Parser
#--------------------------------------------------------------



#--------------------------------------------------------------
# Functions to load and prepare the dataset for Barplot
#--------------------------------------------------------------

loading_and_preparing_ologram_table_barplot <- function(table_path){
  #---------------
  # loading table
  #---------------
  
  
  data_user <- read.table(table_path, 
                          sep="\t",
                          header=TRUE,
                          quote='')
  data_user[,"feature_type"] <- gsub(":", "\n", data_user[,"feature_type"]) 
  
  #---------------
  # Melting table
  #---------------
  
  dm <- data_user
  
  # Create table for summed_bp_overlaps statistics
  #-----------------------------------------------
  
  data_ni_s = dm[, c('feature_type', 'summed_bp_overlaps_expectation_shuffled', 'summed_bp_overlaps_true')]
  maximum_s = apply(X = data_ni_s[,c('summed_bp_overlaps_expectation_shuffled', 'summed_bp_overlaps_true')],
                    MARGIN = 1,
                    FUN = "max")
  
  colnames(data_ni_s) <-  c('Feature', 'Shuffled', 'True')
  
  fc_s <- data_ni_s[,'True'] / (data_ni_s[,'Shuffled'] + 1)
  
  dmm_s <- melt(data_ni_s, id_vars='Feature')
  dmm_s$Statistic <- rep('Total overlap length per region type', nrow(dmm_s))
  
  colnames(dmm_s) <- c('Feature', 'Type', 'Value', 'Statistic')
  dmm_s$Variance <- sqrt(dm[,'summed_bp_overlaps_variance_shuffled'])
  
  # P-value
  #---------
  
  text_s <- dm[, 'summed_bp_overlaps_pvalue']
  
  
  # Format the text
  #----------------
  
  format_p_value <- function(x){
    if(x == 0.0){
      r <- 'p<1e-320'  # If the p-value is ~0 (precision limit), say so
    }else if(x == -1){
      r <- 'p=NA'  # If the p-value was -1, we write 'Not applicable'
    }else{
      r <- paste("p=", formatC(x, format = "e", digits = 2))  # Add 'p=' before and format the p value
    }
    
    return(r)
  }
  
  
  text_s <- sapply(text_s, format_p_value)
  dmm_s$Pval_1 <- dm[,'summed_bp_overlaps_pvalue']
  dmm_s$Pval_2 <- text_s
  dmm_s$Neg_binom <- dm[,'summed_bp_overlaps_negbinom_fit_quality']
  
  
  # Create table for nb_intersections statistics
  #---------------------------------------------
  
  data_ni_n = dm[, c('feature_type', 
                     'nb_intersections_expectation_shuffled', 
                     'nb_intersections_true')]
  
  maximum_n = apply(X = data_ni_n[,c('nb_intersections_expectation_shuffled', 
                                     'nb_intersections_true')],
                    MARGIN = 1,
                    FUN = "max")
  
  colnames(data_ni_n) <-  c('Feature', 'Shuffled', 'True')
  
  fc_n <- data_ni_n[,'True'] / (data_ni_n[,'Shuffled'] + 1)
  
  dmm_n <- melt(data_ni_n, id_vars='Feature')
  dmm_n$Statistic <- rep('Total nb. of intersections per region type', nrow(dmm_n))
  colnames(dmm_n) <- c('Feature', 'Type', 'Value', 'Statistic')
  dmm_n$Variance <- sqrt(dm[,'nb_intersections_variance_shuffled'])
  
  # P-value
  #---------
  
  text_n <- dm[, 'nb_intersections_pvalue']
  text_n <- sapply(text_n, format_p_value)
  dmm_n$Pval_1 <- dm[,'nb_intersections_pvalue']
  dmm_n$Pval_2 <- text_n
  dmm_n$Neg_binom <- dm[,'nb_intersections_negbinom_fit_quality']
  
  # Merge s and n tables
  #---------------------
  
  dmm = bind_rows(dmm_n, dmm_s)
  
  return(dmm)
}


#--------------------------------------------------------------
# Functions to load and prepare the dataset for VolcanoPlot
#--------------------------------------------------------------

loading_and_preparing_ologram_table_volcano <- function(table_path){
  
  #---------------
  # loading table
  #---------------
  
  data_user <- read.table(table_path, 
                          sep="\t",
                          header=TRUE,
                          quote='')
  
  data_user[,"feature_type"] <- gsub(":", "\n", data_user[,"feature_type"]) 
  
  # Preparing a dataframe containing N statistics
  #---------------------------------------------
  mat_n = data_user[, c('feature_type',
                    'nb_intersections_log2_fold_change',
                    'nb_intersections_pvalue')]
  
  # Unavailable p-value are discarded
  #---------------------------------------------
  
  mat_n <- mat_n[!mat_n$nb_intersections_pvalue == -1,]
  
  # Pval set to 0 are changed to  1e-320
  #---------------------------------------------
  mat_n[mat_n$nb_intersections_pvalue == 0, 'nb_intersections_pvalue'] <- 1e-320
  mat_n$minus_log10_pvalue <- -log10(mat_n$nb_intersections_pvalue)
  colnames(mat_n) <- c('Feature', 'log2(FC)', 'p-value', '-log10(pvalue)')
  mat_n$Statistic <- rep('Total nb. of intersections per region type', nrow(mat_n))
  
  # Preparing a dataframe containing S statistics
  #---------------------------------------------
  
  mat_s <- data_user[,c('feature_type',
                        'summed_bp_overlaps_log2_fold_change',
                        'summed_bp_overlaps_pvalue')]
  # Unavailable p-value are discarded
  #---------------------------------------------


  mat_s <- mat_s[!mat_s$summed_bp_overlaps_pvalue == -1,]
  
  # Pval set to 0 are changed to  1e-320
  #---------------------------------------------
  mat_s[mat_s$summed_bp_overlaps_pvalue == 0, 'summed_bp_overlaps_pvalue'] <- 1e-320
  mat_s$minus_log10_pvalue <- -log10(mat_s$summed_bp_overlaps_pvalue)
  colnames(mat_s) <- c('Feature', 'log2(FC)', 'p-value', '-log10(pvalue)')
  mat_s$Statistic <- rep('Total overlap length per region type', nrow(mat_s))
  

  # Merge s and n tables
  #---------------------
  
  df_volc = bind_rows(mat_n, mat_s)
  
  return(df_volc)
}

#--------------------------------------------------------------
# Load user data
#--------------------------------------------------------------



user_barplot_table <- loading_and_preparing_ologram_table_barplot(opt$inputfile)
user_volcano_table <- loading_and_preparing_ologram_table_volcano(opt$inputfile)

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
# Generate output name and render final page
#--------------------------------------------------------------


time_stamp <- format(Sys.time(), "%m%d%Y-%H%M%S")

myData <- data.frame()
try(myData<-read.delim("random_names.txt", header = FALSE))

generate_stamped_rand <- function(){
  rand_int <- sample(1:1000000000,1)
  rand_int <- sprintf("%010d",rand_int) 
  stamped_rand_int <- paste(time_stamp,rand_int,sep = "-")
  return(stamped_rand_int)
}

stamped_rand_int <- generate_stamped_rand()
while(stamped_rand_int %in% myData)
  stamped_rand_int <- generate_stamped_rand()


file_name <- paste(stamped_rand_int,".html",sep = "")
file_path <- "../../resources/views/results/"
random_output <- paste(file_path,file_name,sep = "")

rmarkdown::render("app/Shiny/web_ologram.rmd",
                  params =list(barplot_table=user_barplot_table,volcano_table=user_volcano_table),
                  output_file = random_output)

write(stamped_rand_int , file = "app/Shiny/random_names.txt", append = TRUE,sep = "\n")
write(stamped_rand_int,stdout())

# #--------------------------------------------------------------
# # Define UI 
# #--------------------------------------------------------------
# 
# 
# ui <- fluidPage(
#   
#   theme = shinytheme("yeti"),
#   # App title ----
#   titlePanel("Web-OLOGRAM"),
#   s
# 
#   # Sidebar layout with input and output definitions ----
#   sidebarLayout(
#     
#     # Sidebar panel for inputs ----
#     sidebarPanel(
#       checkboxInput("barplot_coordflip_input", "Flip Coordinates", value = FALSE, width = NULL),
#       br(),
#       # Input: Dopdown for Satistics to use ----
#       selectInput(
#         inputId="theme_input", 
#         label="Theme",
#         choices=themes_avail,
#         selected = NULL,
#         multiple = FALSE,
#         selectize = TRUE,
#         width = NULL,
#         size = NULL
#       ),
#     ),
#     # Main panel for displaying outputs ----
#     mainPanel(
#       
#       # Output: Tabset w/ plot, summary, and table ----
#       tabsetPanel(type = "tabs",
#                   tabPanel("Barplot", 
#                            br(),
#                            # Input: Dopdown for Satistics to use ----
#                            selectInput(
#                              inputId="barplot_statistic_input", 
#                              label="Statistics",
#                              choices=sort(unique(user_barplot_table$Statistic)),
#                              selected = NULL,
#                              multiple = FALSE,
#                              selectize = TRUE,
#                              width = NULL,
#                              size = NULL
#                            ),
#                            br(),
#                            plotOutput("barplot"),
#                   ),
#                   tabPanel("Volcano Plot", 
#                            br(),
#                            # Input: Dopdown for Satistics to use ----
#                            selectInput(
#                              inputId="volcano_statistic_input", 
#                              label="Statistics",
#                              choices=c("Both", sort(unique(user_volcano_table$Statistic))),
#                              selected = NULL,
#                              multiple = FALSE,
#                              selectize = TRUE,
#                              width = NULL,
#                              size = NULL
#                            ),
#                            br(),
#                            plotOutput("volcano_plot"),
#                   ),
#                   tabPanel("Table", 
#                            tableOutput("table")
#                   )
#       )
#       
#     )
#   )
# )
# 
# 
# #--------------------------------------------------------------
# # Define server logic 
# #--------------------------------------------------------------
# 
# server <- function(input, output) {
#   
#   # Reactive expression to generate the requested distribution ----
#   # This is called whenever the inputs change. The output functions
#   # defined below then use the value computed from this expression
#   d <- reactive({
# 
#   })
#   
#   
#   # Generate a plot of the data ----
#   # Also uses the inputs to build the plot label. Note that the
#   # dependencies on the inputs and the data reactive expression are
#   # both tracked, and all expressions are called in the sequence
#   # implied by the dependency graph.
#   
#   output$barplot <- renderPlot({
#     
#     user_barplot_table <- user_barplot_table[user_barplot_table$Statistic == input$barplot_statistic_input,]
#     
#     if(input$barplot_coordflip_input)
#       coord_fliped <- coord_flip()
#     else
#       coord_fliped <- NULL
#     
#     if(!is.null(input$theme_input))
#       my_theme <- do.call(input$theme_input,list(base_size = 11))
#     else
#       my_theme <- do.call('theme_bw',list(base_size = 11))
#     
#     ggplot(user_barplot_table, mapping=aes(x=Feature, y=Value, fill=Type)) + 
#         geom_bar(stat="identity", position = "dodge") +
#       coord_fliped +
#       my_theme
#         
#   })
#   
#   output$volcano_plot <- renderPlot({
#     
#     if(input$volcano_statistic_input != 'Both')
#       user_volcano_table <- user_volcano_table[user_volcano_table$Statistic == input$volcano_statistic_input, ]
#     
#     if(input$barplot_coordflip_input)
#       coord_fliped <- coord_flip()
#     else
#       coord_fliped <- NULL
#     
#     if(!is.null(input$theme_input))
#       my_theme <- do.call(input$theme_input,list(base_size = 11))
#     else
#       my_theme <- do.call('theme_bw',list(base_size = 11))
#     
#     ggplot(user_volcano_table, 
#            mapping=aes(x=.data[['log2(FC)']], 
#                       y=.data[['-log10(pvalue)']], 
#                       color=.data[['Statistic']],
#                       label=.data[['Feature']])) + 
#       geom_vline(xintercept = 0, 
#                  size=0.5) +
#       geom_hline(yintercept = 0, 
#                  size=0.5) +
#       geom_point() +
#       geom_label_repel(box.padding = 0.5) +
#       coord_fliped +
#       my_theme
#     
#   })
#   
#   # Generate a summary of the data ----
#   output$summary <- renderPrint({
#     summary(user_barplot_table)
#   })
#   
#   # Generate an HTML table view of the data ----
#   output$table <- renderTable({
#     user_barplot_table
#   })
#   
# }
# 
# app <- shinyApp(ui, server,options = list("port"=7775,"host"='0.0.0.0'))
# 
# runApp(app)
