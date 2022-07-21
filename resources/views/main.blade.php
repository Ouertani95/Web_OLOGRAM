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
            <a class="nav-link active" aria-current="page" id="homeButton" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
              </svg> <u>Home</u></a>
          </li>
          <li class="nav-item border-end">
            <a class="nav-link" aria-current="page" href="/about" target="_blank" rel=noopener>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-question" viewBox="0 0 16 16">
                <path d="M8.05 9.6c.336 0 .504-.24.554-.627.04-.534.198-.815.847-1.26.673-.475 1.049-1.09 1.049-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.71 1.71 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745z"/>
                <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>
                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0z"/>
              </svg> About</a>
          </li>
          <li class="nav-item dropdown border-end">
            <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
              </svg>   Documentation
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="https://dputhier.github.io/pygtftk/index.html" target="_blank" rel=noopener>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg> PYGTFTK</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="https://dputhier.github.io/pygtftk/ologram.html" target="_blank" rel=noopener>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg> OLOGRAM</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="https://github.com/Ouertani95/Web_OLOGRAM" target="_blank" rel=noopener>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                  <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg> Web-OLOGRAM</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/contact" target="_blank" rel=noopener>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
              </svg> Contact</a>
          </li>
          

        </ul>
        <ul class="navbar-nav d-flex navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <li class="nav-item">
              <a class="btn btn-primary me-3" aria-current="page" id="demoButton"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z"/>
              </svg> Run tour </a>
            </li>

            <a class="btn btn-danger" aria-current="page" id="reportButton" href="/issue" target="_blank" rel=noopener>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bug" viewBox="0 0 16 16">
              <path d="M4.355.522a.5.5 0 0 1 .623.333l.291.956A4.979 4.979 0 0 1 8 1c1.007 0 1.946.298 2.731.811l.29-.956a.5.5 0 1 1 .957.29l-.41 1.352A4.985 4.985 0 0 1 13 6h.5a.5.5 0 0 0 .5-.5V5a.5.5 0 0 1 1 0v.5A1.5 1.5 0 0 1 13.5 7H13v1h1.5a.5.5 0 0 1 0 1H13v1h.5a1.5 1.5 0 0 1 1.5 1.5v.5a.5.5 0 1 1-1 0v-.5a.5.5 0 0 0-.5-.5H13a5 5 0 0 1-10 0h-.5a.5.5 0 0 0-.5.5v.5a.5.5 0 1 1-1 0v-.5A1.5 1.5 0 0 1 2.5 10H3V9H1.5a.5.5 0 0 1 0-1H3V7h-.5A1.5 1.5 0 0 1 1 5.5V5a.5.5 0 0 1 1 0v.5a.5.5 0 0 0 .5.5H3c0-1.364.547-2.601 1.432-3.503l-.41-1.352a.5.5 0 0 1 .333-.623zM4 7v4a4 4 0 0 0 3.5 3.97V7H4zm4.5 0v7.97A4 4 0 0 0 12 11V7H8.5zM12 6a3.989 3.989 0 0 0-1.334-2.982A3.983 3.983 0 0 0 8 2a3.983 3.983 0 0 0-2.667 1.018A3.989 3.989 0 0 0 4 6h8z"/>
              </svg> Report issue
            </a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  
  {{-- This is where the main components will be placed --}}
  <div class="container mb-5 mt-6 pt-3 ">

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

    <div class="row justify-content-center mt-4">
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
