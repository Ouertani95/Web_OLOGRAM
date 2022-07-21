<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/introjs-5.1.0.min.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-icons-1.8.3/bootstrap-icons.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/custom.css") }}>

    <title>Web-OLOGRAM</title>

</head>
<body>

  {{-- This is the navigation bar on the top --}}
  <nav class="navbar navbar-dark fixed-top bg-dark navbar-expand-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Web-OLOGRAM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item border-end">
            <a class="nav-link active" aria-current="page" id="homeButton" href="/"><i class="bi bi-house"></i> Home</a>
          </li>
          <li class="nav-item border-end">
            <a class="nav-link" aria-current="page" href="/about" target="_blank" rel=noopener><i class="fa-solid fa-person-chalkboard"></i> About</a>
          </li>
          <li class="nav-item dropdown border-end">
            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-book"></i> Documentation
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="https://dputhier.github.io/pygtftk/index.html" target="_blank" rel=noopener><i class="bi bi-github"></i> PYGTFTK</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="https://dputhier.github.io/pygtftk/ologram.html" target="_blank" rel=noopener><i class="bi bi-github"></i> OLOGRAM</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="https://github.com/Ouertani95/Web_OLOGRAM" target="_blank" rel=noopener><i class="bi bi-github"></i> Web-OLOGRAM</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/contact" target="_blank" rel=noopener><i class="fa-solid fa-address-card"></i> Contact</a>
          </li>
          

        </ul>
        <ul class="navbar-nav d-flex navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="btn btn-primary me-3" aria-current="page" id="demoButton"><i class="bi bi-play"></i> Run tour </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger" aria-current="page" id="reportButton" href="/issue" target="_blank" rel=noopener><i class="bi bi-bug-fill"></i> Report issue </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  
  {{-- This is where the main components will be placed --}}
  <div class="container mb-5 mt-7 pt-3 ">

    <div class="row">
      <div class="col text-center">
        <h1 class="mt-2 mb-4"> WELCOME TO OLOGRAM </h1><br>

        <!-- this part is needed to show the success message from the routing file with post -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li id="success_field">{!! \Session::get('success') !!}</li>
            </ul>
            <a class="btn btn-primary" href="{!! \Session::get('feed_link') !!}" role="button" target="_blank" rel=noopener>Live feed</a>
        </div>
        @endif
        
        <!-- show error message from redirection -->
        @if (\Session::has('error'))
        <div class="alert alert-danger alert-block">
            <ul>
                <li id="error_field">{!! \Session::get('error') !!}</li>
            </ul>
        </div>
        @endif

        <!-- show error messages if there are any from validation -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
    </div>

    <div class="row justify-content-center mt-6">
      <div class="col text-center">
        <nav>
          <div class="nav nav-pills nav-fill mb-3" id="nav-tab" role="tab-list" data-title="Different cases" data-intro="These are the different cases of analysis for your BED files.">
            
            @if (\Session::has('case2_show')||\Session::has('case3_show')||\Session::has('case4_show'))
              <button class="nav-link border border-dark rounded-3" id="nav-BED-GTF-tab" data-bs-toggle="tab" data-bs-target="#case1" type="button" role="tab" aria-controls="case1" aria-selected="true">BED vs GTF</button>
            @else
              <button class="nav-link border border-dark rounded-3 active" id="nav-BED-GTF-tab" data-bs-toggle="tab" data-bs-target="#case1" type="button" role="tab" aria-controls="case1" aria-selected="true">BED vs GTF</button>
            @endif
  
            @if (\Session::has('case2_show'))
              <button class="nav-link border border-dark rounded-3 active" id="nav-BED-GTF-keys-tab" data-bs-toggle="tab" data-bs-target="#case2" type="button" role="tab" aria-controls="case2" aria-selected="true">BED vs GTF (keys)</button>
            @else
              <button class="nav-link border border-dark rounded-3" id="nav-BED-GTF-keys-tab" data-bs-toggle="tab" data-bs-target="#case2" type="button" role="tab" aria-controls="case2" aria-selected="true">BED vs GTF (keys)</button>
            @endif
  
            @if (\Session::has('case3_show'))
              <button class="nav-link border border-dark rounded-3 active" id="nav-BED-BED-tab" data-bs-toggle="tab" data-bs-target="#case3" type="button" role="tab" aria-controls="case3" aria-selected="true">BED vs BED</button>        
            @else
              <button class="nav-link border border-dark rounded-3" id="nav-BED-BED-tab" data-bs-toggle="tab" data-bs-target="#case3" type="button" role="tab" aria-controls="case3" aria-selected="true">BED vs BED</button>
            @endif
  
            @if (\Session::has('case4_show'))
              <button class="nav-link border border-dark rounded-3 active" id="nav-BED-BED-combo-tab" data-bs-toggle="tab" data-bs-target="#case4" type="button" role="tab" aria-controls="case4" aria-selected="true">BED vs BED (combinations)</button>          
            @else
              <button class="nav-link border border-dark rounded-3" id="nav-BED-BED-combo-tab" data-bs-toggle="tab" data-bs-target="#case4" type="button" role="tab" aria-controls="case4" aria-selected="true">BED vs BED (combinations)</button>
            @endif
  
          </div>
        </nav>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col text-center">
        <div class="tab-content" id="nav-tabContent1">
          @if (\Session::has('case2_show')||\Session::has('case3_show')||\Session::has('case4_show'))
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3" id="case1" role="tabpanel" aria-labelledby="nav-BED-GTF-tab">
          @else 
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3 show active" id="case1" role="tabpanel" aria-labelledby="nav-BED-GTF-tab">
          @endif
                <div>
                    <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm">
                        @csrf 
                        <!-- @csrf is mandatory for forms with post method -->
                        <div class="row no-gutters text-center">
                          <div class="col-sm-4 text-start">

                            <div class="modal fade" id="case1explanation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="case1explanationTitle" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="case1explanationTitle">BED vs GTF</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p>
                                      My BED file against a GTF.<br><br>I have a set of regions, I want to see which gene-centric elements they are enriched with.
                                    </p>

                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <button type="button" id="case1DetailsButton" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#case1explanation">
                              Case details
                            </button>
                          </div>
                          <div class="col-sm-4">
                            <h3 class="fw-bold mb-5">Required input</h3>
                          </div>
                          
                          
                        </div>
    
                        <div class="row no-gutters text-center" id="case1-required" data-title="Required options" data-intro="On the left side you have your required options.">
                          
                          
                          <div class="col-sm-6 text-center" >
    
                            
                            
                            <input type="hidden" name="caseId" value="case1">
    
                            <p class="text-start  mb-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="Required email address to send the final results to."></i></p> 
                            <div class="input-group-sm mb-3 ">
                              <input type="email" class="form-control form-control-sm" id="email1" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                            </div>
                            
                            <div id="ensgtf1input">
                              <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl reference GTF file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose reference GTF directly from Ensembl."></i></p>
                              <div class="input-group-sm mb-1 ">  
                                <select class="form-select" aria-label="Default select example" id="ens_gtf1" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose reference GTF directly from Ensembl" required>
                                    <option selected></option>
                                    @foreach ($links as $link)
                                    <option value="{{ $link }}" >{{ $link }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            
    
                            <div class="d-none" id="gtf1input">
                              <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Reference GTF file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…)."></i></p>
                              <div class="input-group-sm mb-1">
                                <input class="form-control "  id="gtf1" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                              </div>
                            </div>
    
                            <div class="form-check form-switch text-start mb-3" id="switchgroup">
                              <input class="form-check-input border border-primary" type="checkbox" role="switch" id="gtfswitch1" value="false">
                              <label class="form-check-label" for="gtfswitch1">Use personal GTF file</label>
                            </div>

                           
                           
    
                            
                          </div>
                            
                          <div class="col-sm-6 text-center" data-title="Required options" data-intro="On the left side you have your required options.">
    
                            <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Query BED file <i class="bi bi-info-circle" id="bed1-info" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="BED file containing the set of regions for which the enrichment will be calculated."></i></p>
                            <div class="input-group-sm mb-3">
                              <input class="form-control "  id="bed1" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" data-title="BED file" data-intro="This is the BED file containing the set of regions for which the enrichment will be calculated."
                              title="BED file containing the set of regions for which the enrichment will be calculated." required>
                            </div>
    
                            
    
                            {{-- <div class="progress mb-3">
                              <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
    
                            <div id="enschr1input">
                              <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl chrmosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose chromosome sizes directly from Ensembl"></i></p>
                              <div class="input-group-sm mb-1 ">  
                                <select class="form-select" aria-label="Default select example" id="ens_chr1" name="ens_chr" value="{{ old("ens_chr") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose chromosome sizes directly from Ensembl" required>
                                    <option selected></option>
                                    @foreach ($links as $link)
                                    <option value="{{ $link }}" >{{ $link }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
    
                            <div class="d-none" id="chr1input">
                              <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Chromosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2."></i></p>
                              <div class="input-group-sm mb-1">
                                <input class="form-control "  id="chr1" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                              </div>
                            </div>
    
                            <div class="form-check form-switch text-start mb-3">
                              <input class="form-check-input border border-primary" type="checkbox" role="switch" id="chrswitch1" value="false">
                              <label class="form-check-label" for="chrswitch1">Use personal chromosome sizes file</label>
                            </div>
                            
    
    
                          </div>
                          
                          
                        </div>
    
                        <div class="row no-gutters text-center">
                          <div class="col-sm-8 text-center">
                            <div class="accordion" id="case1-accordion-advanced">
                              <div class="accordion-item justify-content-center text-center">
                                <h2 class="accordion-header justify-content-center text-center border border-dark rounded-3" id="heading1-advanced">
                                  <button class="accordion-button" id="case1-acc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-advanced" aria-expanded="true" aria-controls="collapse1-advanced">
                                    Advanced options
                                  </button>
                                </h2>
    
                                @if (\Session::has('case1_show'))
                                <div id="collapse1-advanced" class="accordion-collapse collapse show" aria-labelledby="heading1-advanced" data-bs-parent="#case1-accordion-advanced">
                                @else
                                <div id="collapse1-advanced" class="accordion-collapse collapse" aria-labelledby="heading1-advanced" data-bs-parent="#case1-accordion-advanced">
                                @endif
    
                                  <div class="accordion-body">
                                    <div class="row">
    
                                      <div class="col-sm-6 text-start">
    
                                        <p class="text-start  mb-1"><i class="bi bi-files"></i> Reference BED files <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)."></i></p>
                                        <div class="input-group-sm mb-3">
                                          <input class="form-control" type="file" id="mbed1" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                        </div>
    
    
                                        <p class="text-start  mb-1"><i class="bi bi-card-list"></i> Reference BED files labels <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting."></i></p>
                                        <div class="input-group-sm mb-3">
                                          <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id ="mbedl1" >{{ old('mbedl') }}</textarea>
                                        </div>
    
                                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED inclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)."></i></p>
                                        <div class="input-group-sm mb-3">
                                          <input class="form-control " id="bedin1"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                        </div>
    
                                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED exclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)."></i></p>
                                        <div class="input-group-sm mb-3">
                                          <input class="form-control " id="bedex1" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                        </div>
    
                                      </div>
    
                                      <div class="col-sm-6 text-start">
    
                                        <div class="form-check" data-title="Test" data-intro="This is a test.">
                                          <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg1" name="fcg">
                                          <p class="text-start  mb-1">Force-chrom-gtf <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                            title="Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file."></i></p>          
                                        </div>
    
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp1" name="fcp">
                                          <p class="text-start  mb-1">Force-chrom-peak <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                            title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”."></i></p>
                                        </div>
    
                                        <div class="form-check mb-3">
                                          <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb1" name="fcmb">
                                          <p class="text-start  mb-1">Force-chrom-more-bed <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                            title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”."></i></p>
                                        </div>
    
                                        <p class="text-start  mb-1"><i class="bi bi-arrow-up-square"></i> Upstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)"></i></p>
                                        <div class="input-group-sm mb-3">
                                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups1" value="{{ old('ups') }}">
                                        </div>
    
                                        <p class="text-start  mb-1"><i class="bi bi-arrow-down-square"></i> Downstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)"></i></p>
                                        <div class="input-group-sm mb-3">
                                          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" id="dns1" value="{{ old('dns') }}">
                                        </div>
                                        
                                      </div>
    
                                      
    
    
    
    
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
    
                          <div class="col text-center mt-1">
    
                            <button type="submit" class="btn btn-dark btn-lg" id="case1-submit" data-title="Submit button" data-intro="Once you finished adding your files and options you can click this button to submit.">Submit request</button></br><br>
    
                          </div>
    
                        </div>
    
    
                        
    
                      </form> 
                </div>
            </div>
    
        </div>
    
        <div class="tab-content" id="nav-tabContent2">
          @if (\Session::has('case2_show'))
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3 show active" id="case2" role="tabpanel" aria-labelledby="nav-BED-GTF-keys-tab">
          @else
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3" id="case2" role="tabpanel" aria-labelledby="nav-BED-GTF-keys-tab">
          @endif
                <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm2">
                    @csrf 
                    <!-- @csrf is mandatory for forms with post method -->
    
                    <div class="row no-gutters text-center">
                      <div class="col-sm-4 text-start">

                        <div class="modal fade" id="case2explanation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="case2explanationTitle" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title w-100 text-center" id="case2explanationTitle">BED vs GTF (keys)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p>
                                  My BED file against keys/values from a GTF.<br><br>I have a set of regions, I want to see which value from any GTF key they are associated with (e.g. lncRNA, snoRNA, miRNA...  from gene_biotype key).
                                </p>

                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#case2explanation">
                          Case details
                        </button>
                      </div>
                      <div class="col-sm-4">
                        <h3 class="fw-bold mb-5">Required input</h3>
                      </div>
                      
                      
                    </div>
    
                    <div class="row no-gutters text-center">
                      <div class="col-sm-4 text-center">
    
    
                        <input type="hidden" name="caseId" value="case2">
    
                        <p class="text-start  mb-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Required email address to send the final results to."></i></p>
                        <div class="input-group-sm mb-3">
                          <input type="email" class="form-control form-control-sm" id="email2" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                        </div>
                        
                        <div id="ensgtf2input">
                          <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl reference GTF file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose reference GTF directly from Ensembl."></i></p>
                          <div class="input-group-sm mb-1"> 
                            <select class="form-select" aria-label="Default select example" id="ens_gtf2" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose reference GTF directly from Ensembl" required>
                                <option selected></option>
                                @foreach ($links as $link)
                                <option value="{{ $link }}" >{{ $link }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="d-none" id="gtf2input">
                          <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Reference GTF file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…)."></i></p>
                          <div class="input-group-sm mb-1">
                            <input class="form-control " id="gtf2" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                          </div>
                        </div>

                        <div class="form-check form-switch text-start mb-3">
                          <input class="form-check-input border border-primary" type="checkbox" role="switch" id="gtfswitch2" value="false">
                          <label class="form-check-label" for="gtfswitch2">Use personal GTF file</label>
                        </div>

                        
    
                      </div>
    
                      <div class="col-sm-4 text-center">

                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Query BED file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which the enrichment will be calculated."></i></p>
                        <div class="input-group-sm mb-3">
                          <input class="form-control " id="bed2" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which the enrichment will be calculated." required>
                        </div>
                        
                        <p class="text-start  mb-1"><i class="bi bi-card-list"></i> GTF keys <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'"></i></p>
                        <div class="input-group-sm mb-3">
                          <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'" name="keys" id="keys" required>{{ old('keys') }}</textarea>
                        </div>

                        
    
                      </div>
    
                      <div class="col-sm-4 text-center">

                            
                        <div id="enschr2input">
                          <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl chrmosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose chromosome sizes directly from Ensembl"></i></p>
                          <div class="input-group-sm mb-1">  
                            <select class="form-select" aria-label="Default select example" id="ens_chr2" name="ens_chr" value="{{ old("ens_chr") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose chromosome sizes directly from Ensembl" required>
                                <option selected></option>
                                @foreach ($links as $link)
                                <option value="{{ $link }}" >{{ $link }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        
                        <div class="d-none" id="chr2input">
                          <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Chromosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2."></i></p>
                          <div class="input-group-sm mb-1">
                            <input class="form-control " id="chr2" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                          </div>
                        </div>  

                        <div class="form-check form-switch text-start mb-3">
                          <input class="form-check-input border border-primary" type="checkbox" role="switch" id="chrswitch2" value="false">
                          <label class="form-check-label" for="chrswitch2">Use personal chromosome sizes file</label>
                        </div>
                        
    
                        
    
                      </div>
                    </div>
    
                    
    
                    <div class="row no-gutters text-center">
                      <div class="col-sm-8 text-center">
                        
                        <div class="accordion" id="case2-accordion-advanced">
                          <div class="accordion-item">
                            <h2 class="accordion-header border border-dark rounded-3" id="heading2-advanced">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2-advanced" aria-expanded="true" aria-controls="collapse2-advanced">
                                Advanced options
                              </button>
                            </h2>
    
                            @if (\Session::has('case2_show'))
                            <div id="collapse2-advanced" class="accordion-collapse collapse show" aria-labelledby="heading2-advanced" data-bs-parent="#case2-accordion-advanced">
                            @else
                            <div id="collapse2-advanced" class="accordion-collapse collapse " aria-labelledby="heading2-advanced" data-bs-parent="#case2-accordion-advanced">
                            @endif
    
                              <div class="accordion-body">
                                <div class="row">
                                  
    
                                  <div class="col-sm-6 text-start">
    
                                    <p class="text-start  mb-1"><i class="bi bi-files"></i> Reference BED files <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)."></i></p>
                                    <div class="input-group-sm mb-3">
                                      <input class="form-control" type="file" id="mbed2" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-card-list"></i> Reference BED files labels <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting."></i></p>
                                    <div class="input-group-sm mb-3">
                                      <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id="mbedl2">{{ old('mbedl') }}</textarea>
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED inclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)."></i></p>
                                    <div class="input-group-sm mb-3">
                                      <input class="form-control " id="bedin2"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED exclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)."></i></p>
                                    <div class="input-group-sm mb-3">
                                      <input class="form-control " id="bedex2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                    </div>
    
                                  </div>
    
                                  <div class="col-sm-6 text-start">
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg2" name="fcg">
                                      <p class="text-start  mb-1">Force-chrom-gtf <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file."></i></p>          
                                    </div>
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp2" name="fcp">
                                      <p class="text-start  mb-1">Force-chrom-peak <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”."></i></p>
                                    </div>
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb2" name="fcmb">
                                      <p class="text-start  mb-1">Force-chrom-more-bed <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”."></i></p>
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-arrow-up-square"></i> Upstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)"></i></p>
                                    <div class="input-group-sm mb-3">
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups2" value="{{ old('ups') }}">
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-arrow-down-square"></i> Downstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)"></i></p>
                                    <div class="input-group-sm mb-3">
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" id="dns2" value="{{ old('dns') }}">
                                    </div>
                                    
                                  </div>
    
    
                                </div>
                              </div>
                            </div>  
                          </div>
                        </div>
    
                      </div>
    
                      <div class="col-sm-4 text-center">
    
                        <button type="submit" class="btn btn-dark btn-lg mt-1">Submit request</button></br><br>
    
                      </div>
    
    
                    </div>
    
                    
    
                  </form> 
            </div>
        </div>
    
    
        <div class="tab-content" id="nav-tabContent3">
          @if (\Session::has('case3_show'))
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3 show active" id="case3" role="tabpanel" aria-labelledby="nav-BED-BED-tab">
          @else
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3" id="case3" role="tabpanel" aria-labelledby="nav-BED-BED-tab">
          @endif
                <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm3">
                    @csrf 
                    <!-- @csrf is mandatory for forms with post method -->
                    <div class="row no-gutters text-center">
                      <div class="col-sm-4 text-start">

                        <div class="modal fade" id="case3explanation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="case3explanationTitle" style="display: none;" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title  w-100 text-center" id="case3explanationTitle">BED vs BED</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p>
                                  My BED file against a set of BED files.<br><br>I have a set of regions, I want to see which set of regions they are enriched with.
                                </p>

                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#case3explanation">
                          Case details
                        </button>
                      </div>
                      <div class="col-sm-4">
                        <h3 class="fw-bold mb-5">Required input</h3>
                      </div>
                      
                      
                    </div>
    
    
                    <div class="row no-gutters text-center">
                      <div class="col-sm-6 text-center">
    
                        <input type="hidden" name="caseId" value="case3">
    
                        <p class="text-start  mb-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Required email address to send the final results to."></i></p>
    
                        <div class="input-group-sm mb-3">
                          <input type="email" class="form-control form-control-sm" id="email3" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                        </div>
    
                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Query BED file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which the enrichment will be calculated."></i></p>
    
    
                        <div class="input-group-sm mb-3">
                          <input class="form-control " id="bed3" type="file" name="bed" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which the enrichment will be calculated." required>
                        </div>
    
    
    
                      </div>
    
                      <div class="col-sm-6 text-center">
    
                        <p class="text-start  mb-1"><i class="bi bi-files"></i> Reference BED files <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Ref BED : A list of bed files to be considered as genomic annotations."></i></p>
                        <div class="input-group-sm mb-3">
                          <input class="form-control" type="file" id="mbed3" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Ref BED : A list of bed files to be considered as genomic annotations." required>
                        </div>
    

                        <div id="enschr3input">
                          <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl chrmosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose chromosome sizes directly from Ensembl"></i></p>
                          <div class="input-group-sm mb-1 ">  
                            <select class="form-select" aria-label="Default select example" id="ens_chr3" name="ens_chr" value="{{ old("ens_chr") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Choose chromosome sizes directly from Ensembl" required>
                                <option selected></option>
                                @foreach ($links as $link)
                                <option value="{{ $link }}" >{{ $link }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="d-none" id="chr3input">
                          <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Chromosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2."></i></p>
                          <div class="input-group-sm mb-1">
                            <input class="form-control " id="chr3" type="file" name="chr" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                          </div>
                        </div>

                        <div class="form-check form-switch text-start mb-3">
                          <input class="form-check-input border border-primary" type="checkbox" role="switch" id="chrswitch3" value="false">
                          <label class="form-check-label" for="chrswitch3">Use personal chromosome sizes file</label>
                        </div>
    
                      </div>
                    </div>
                    
                    <div class="row no-gutters text-center">
                      <div class="col-sm-8 text-center">
    
                        <div class="accordion" id="case3-accordion-advanced">
                          <div class="accordion-item">
                            <h2 class="accordion-header border border-dark rounded-3" id="heading3-advanced">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3-advanced" aria-expanded="true" aria-controls="collapse3-advanced">
                                Advanced options
                              </button>
                            </h2>
    
                            @if (\Session::has('case3_show'))
                            <div id="collapse3-advanced" class="accordion-collapse collapse show" aria-labelledby="heading3-advanced" data-bs-parent="#case3-accordion-advanced">
                            @else
                            <div id="collapse3-advanced" class="accordion-collapse collapse " aria-labelledby="heading3-advanced" data-bs-parent="#case3-accordion-advanced">
                            @endif
    
                              <div class="accordion-body">
                                <div class="row">
    
                                  <div class="col-sm-6 text-start">
    
                                    <p class="text-start  mb-1"><i class="bi bi-card-list"></i> Reference BED files labels <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting."></i></p>
    
    
                                    <div class="input-group-sm mb-3">
                                      <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id="mbedl3">{{ old('mbedl') }}</textarea>
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED inclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)."></i></p>
    
                                    <div class="input-group-sm mb-3">
                                      <input class="form-control " id="bedin3"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED exclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)."></i></p>
    
                                    <div class="input-group-sm mb-3">
                                      <input class="form-control " id="bedex3" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                    </div>
    
                                  </div>
    
                                  <div class="col-sm-6 text-start">
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg3" name="fcg">
                                      <p class="text-start  mb-1">Force-chrom-gtf <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file."></i></p>          
                                    </div>
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp3" name="fcp">
                                      <p class="text-start  mb-1">Force-chrom-peak <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”."></i></p>
                                    </div>
    
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb3" name="fcmb">
                                      <p class="text-start  mb-1">Force-chrom-more-bed <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”."></i></p>
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-arrow-up-square"></i> Upstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)"></i></p>
    
                                    <div class="input-group-sm mb-3">
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups3" value="{{ old('ups') }}">
                                    </div>
    
                                    <p class="text-start  mb-1"><i class="bi bi-arrow-down-square"></i> Downstream <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)"></i></p>
    
                                    <div class="input-group-sm mb-3">
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" id="dns3" value="{{ old('dns') }}">
                                    </div>
                                    
                                  </div>
    
    
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
    
                      <div class="col-sm-4 text-center">
    
                        <button type="submit" class="btn btn-dark btn-lg mt-1">Submit request</button></br><br>
    
                      </div>
    
                    </div>
                    
    
                  </form> 
            </div>
        </div>
    
    
    
    
    
    
    
    
        <div class="tab-content" id="nav-tabContent4">
          @if (\Session::has('case4_show'))
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3 show active" id="case4" role="tabpanel" aria-labelledby="nav-BED-BED-combo-tab">
          @else
            <div class="tab-pane border border-2 border-dark rounded-3 fade p-3" id="case4" role="tabpanel" aria-labelledby="nav-BED-BED-combo-tab">
          @endif
                <div>
                    <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm4">
                        @csrf 
                        <!-- @csrf is mandatory for forms with post method -->
    
                        <div class="row no-gutters text-center">
                          <div class="col-sm-4 text-start">

                            <div class="modal fade" id="case4explanation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="case4explanationTitle" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="case4explanationTitle">BED vs BED (combinations)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p>
                                      My BED file against a set of BED files to find combinations.<br><br>I have a set of regions, I want to find n-wise overlaps of genomic features (n > 2).<br><br>Think about using BED inclusion file to enforce statistical power.
                                    </p>

                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#case4explanation">
                              Case details
                            </button>
                          </div>
                          <div class="col-sm-4">
                            <h3 class="fw-bold mb-5">Required input</h3>
                          </div>
                          
                          
                        </div>
    
                        <div class="row no-gutters text-center">
                          <div class="col-sm-6 text-center">
    
                            <input type="hidden" name="caseId" value="case4">
    
                            <p class="text-start  mb-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="Required email address to send the final results to."></i></p>
              
                            <div class="input-group-sm mb-3">
                              <input type="email" class="form-control form-control-sm" id="email4" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                              data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                            </div>
    
                            <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Query BED file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="BED file containing the set of regions for which the enrichment will be calculated."></i></p>
    
                            <div class="input-group-sm mb-3">
                              <input class="form-control " id="bed4" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="BED file containing the set of regions for which combinations are searched." required>
                            </div>
                          </div>
    
                          <div class="col-sm-6 text-center">
    
                            <p class="text-start  mb-1"><i class="bi bi-files"></i> Reference BED files <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="Ref BED : A list of bed files to be considered as genomic annotations."></i></p>    
                            <div class="input-group-sm mb-3">
                              <input class="form-control" type="file" id="mbed4" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="Ref BED : A list of bed files that contains locations of  potential interactors of query." required>
                            </div>
                            
                            <div id="enschr4input">
                              <p class="text-start  mb-1"><i class="bi bi-files"></i> Ensembl chrmosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose chromosome sizes directly from Ensembl"></i></p>
                              <div class="input-group-sm mb-1 ">  
                                <select class="form-select" aria-label="Default select example" id="ens_chr4" name="ens_chr" value="{{ old("ens_chr") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Choose chromosome sizes directly from Ensembl" required>
                                    <option selected></option>
                                    @foreach ($links as $link)
                                    <option value="{{ $link }}" >{{ $link }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="d-none" id="chr4input">
                              <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> Chromosome sizes file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2."></i></p>    
                              <div class="input-group-sm mb-1">
                                <input class="form-control " id="chr4" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                              </div>
                            </div>

                            <div class="form-check form-switch text-start mb-3">
                              <input class="form-check-input border border-primary" type="checkbox" role="switch" id="chrswitch4" value="false">
                              <label class="form-check-label" for="chrswitch4">Use personal chromosome sizes file</label>
                            </div>
    
    
                          </div>
                          
                        </div>
    
                        <div class="row no-gutters text-center"> 
                          <div class="col-sm-8 text-center">
                            <div class="accordion" id="case4-accordion-advanced">
                              <div class="accordion-item">
                                <h2 class="accordion-header border border-dark rounded-3" id="heading4-advanced">
                                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4-advanced" aria-expanded="true" aria-controls="collapse4-advanced">
                                    Advanced options
                                  </button>
                                </h2>
    
                                @if (\Session::has('case4_show'))
                                <div id="collapse4-advanced" class="accordion-collapse collapse show" aria-labelledby="heading4-advanced" data-bs-parent="#case4-accordion-advanced">
                                @else
                                <div id="collapse4-advanced" class="accordion-collapse collapse " aria-labelledby="heading4-advanced" data-bs-parent="#case4-accordion-advanced">
                                @endif
                                
                                  <div class="accordion-body">
                                    <div class="row">
    
                                      <div class="col-sm-6 text-start">
    
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="1" {{ old('exact') ? 'checked' : null }} id="exact" name="exact" >
                                          <p class="text-start  mb-1">Exact <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                            title="Exact : Whether to perform a transitive counting or not. For example, if true, observations of A+B+C will counts as observations of A+B. (but not as observations of A+B+D)"></i></p>              
                                        </div>
    
                                        <p class="text-start  mb-1">Max combinations <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned."></i></p>
    
                                        <div class="input-group-sm mb-3">
                                          <input type="text" class="form-control" name="max" id="max" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned." value="{{ old('max') }}">
                                        </div>
    
                                      </div>
    
                                      <div class="col-sm-6 text-start">
    
                                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED inclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)."></i></p>    
                                        
                                        <div class="input-group-sm mb-3">
                                          <input class="form-control " id="bedin4" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">
                                        </div>
    
                                        <p class="text-start  mb-1"><i class="bi bi-file-earmark-arrow-up"></i> BED exclusion file <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)."></i></p>    
    
                                        <div class="input-group-sm mb-3">
                                          <input class="form-control " id="bedex4" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                          title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                        </div>
    
                                      </div>
    
    
                                    </div>
                                  </div>
                                </div>
                              </div>
    
                            </div>
                          </div>
    
                          <div class="col-sm-4 text-center">
    
                            <button type="submit" class="btn btn-dark btn-lg mt-1">Submit request</button></br><br>
        
                          </div>
    
                        </div>
                        
    
                      </form> 
                </div>
            </div>
        
        </div>
      </div>
    </div>

    
  </div>

  <div class="container fixed-bottom">
    <div class="row no-gutters justify-content-center text-center">
      <div class="col-6 text-center">
        <nav class="navbar  navbar-expand-lg navbar-light bg-white">

          <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScrollBottom" aria-controls="navbarScrollBottom" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScrollBottom">
              <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                  <a class="col-md-2 mb-0 text-muted text-center text-decoration-none" aria-current="page" href="#">© 2022 Web-OLOGRAM </a>
                </li>
              </ul>
              <ul class="navbar-nav d-flex navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                  <a class="col-md-2 mb-0 text-muted text-center text-decoration-none" aria-current="page" href="#">PYGTFTK v1.6.2 </a>
                </li>
              </ul>
            </div>
          </div>
        
        </nav>
      </div>
    </div>
    
  </div>

  <script type="text/javascript" src={{ asset("js/bootstrap.bundle-5.1.3.min.js") }} ></script>
  <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>
  <script type="text/javascript" src={{ asset("js/fontawesome-6.1.1.js") }}></script>
  <script type="text/javascript" src={{ asset("js/intro-5.1.0.min.js") }}></script>
  <script type="text/javascript" src={{ asset("js/custom.js") }} ></script>


  <script type="text/javascript" src={{ asset("js/glowCookies-3.1.7.min.js") }}></script>

  <script>
      glowCookies.start('en', { 
          style: 1,
          analytics: 'G-FH87DE17XF', 
          facebookPixel: '990955817632355',
          policyLink: 'https://link-to-your-policy.com',
          position: 'right',
      });
  </script>

</body>

</html>
