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
  
  #-----------------------------------------------
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
  dmm_s$Variance <- formatC(sqrt(dm[,'summed_bp_overlaps_variance_shuffled']),format="f",digits=2) 
  dmm_s$Variance <- as.numeric(dmm_s$Variance)

  #---------
  # P-value
  #---------
  
  text_s <- dm[, 'summed_bp_overlaps_pvalue']
  
  #----------------
  # Format the text
  #----------------
  
  format_p_value <- function(x){
    if(x == 0.0){
      r <- 'p<1e-320'  # If the p-value is ~0 (precision limit), say so
    }else if(x == -1){
      r <- 'p=NA'  # If the p-value was -1, we write 'Not applicable'
    }else{
      r <- formatC(x, format = "e", digits = 2) # format the p value
    }
    
    return(r)
  }
  
  
  text_s <- sapply(text_s, format_p_value)
  dmm_s$Pval <- as.numeric(as.character(text_s)) 
  dmm_s$Neg_binom_fit <- dm[,'summed_bp_overlaps_negbinom_fit_quality']
  
  #---------------------------------------------
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
  dmm_n$Variance <- formatC(sqrt(dm[,'nb_intersections_variance_shuffled']),format="f",digits=2)  
  dmm_n$Variance <- as.numeric(dmm_n$Variance)

  #---------
  # P-value
  #---------
  
  text_n <- dm[, 'nb_intersections_pvalue']
  text_n <- sapply(text_n, format_p_value)
  dmm_n$Pval <- as.numeric(as.character(text_n)) 
  dmm_n$Neg_binom_fit <- dm[,'nb_intersections_negbinom_fit_quality']
  
  #---------------------
  # Merge s and n tables
  #---------------------
  
  dmm = bind_rows(dmm_n, dmm_s)
  dmm$Significant = ifelse(dmm$Pval <= 0.05,"true","false")
  
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

  #----------------------------------------------
  # Preparing a dataframe containing N statistics
  #----------------------------------------------
  mat_n = data_user[, c('feature_type',
                        'nb_intersections_log2_fold_change',
                        'nb_intersections_pvalue')]

  #----------------------------------
  # Unavailable p-value are discarded
  #----------------------------------
  
  mat_n <- mat_n[!mat_n$nb_intersections_pvalue == -1,]
  
  #--------------------------------------
  # Pval set to 0 are changed to  1e-320
  #--------------------------------------

  mat_n[mat_n$nb_intersections_pvalue == 0, 'nb_intersections_pvalue'] <- 1e-320
  mat_n$minus_log10_pvalue <- -log10(mat_n$nb_intersections_pvalue)
  colnames(mat_n) <- c('Feature', 'log2(FC)', 'p-value', '-log10(pvalue)')
  mat_n$Statistic <- rep('Total nb. of intersections per region type', nrow(mat_n))
  
  #----------------------------------------------
  # Preparing a dataframe containing S statistics
  #----------------------------------------------
  
  mat_s <- data_user[,c('feature_type',
                        'summed_bp_overlaps_log2_fold_change',
                        'summed_bp_overlaps_pvalue')]
  
  #----------------------------------
  # Unavailable p-value are discarded
  #----------------------------------
  
  
  mat_s <- mat_s[!mat_s$summed_bp_overlaps_pvalue == -1,]
  
  #-------------------------------------
  # Pval set to 0 are changed to  1e-320
  #-------------------------------------

  mat_s[mat_s$summed_bp_overlaps_pvalue == 0, 'summed_bp_overlaps_pvalue'] <- 1e-320
  mat_s$minus_log10_pvalue <- -log10(mat_s$summed_bp_overlaps_pvalue)
  colnames(mat_s) <- c('Feature', 'log2(FC)', 'p-value', '-log10(pvalue)')
  mat_s$Statistic <- rep('Total overlap length per region type', nrow(mat_s))
  
  
  #---------------------
  # Merge s and n tables
  #---------------------
  
  df_volc = bind_rows(mat_n, mat_s)
  
  return(df_volc)
}

#-----------------------------
# List available ggplot themes
#-----------------------------
loading_available_themes <- function(){
  themes_avail <- c(grep("^theme_", 
                         ls("package:ggplot2"), 
                         val=TRUE), 
                    grep("^theme_", 
                         ls("package:ggthemes"), 
                         val=TRUE))
  
  themes_avail <- themes_avail[-grep("^theme_get$", themes_avail)]
  return(themes_avail) 
}