<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/introjs-5.1.0.min.css") }}>

    <title>OLOGRAM test</title>

</head>
<body>

  {{-- This is the navigation bar on the top --}}
  <nav class="navbar navbar-dark fixed-top bg-dark navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">OLOGRAM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
        </ul>
        <form class="d-flex">
          <input type="search" class="form-control" id="search-input" placeholder="Search docs..." aria-label="Search docs for..." autocomplete="off" data-bd-docs-version="5.0">
          <button class="btn btn-outline-success" type="submit" >Search</button>
        </form>
      </div>
    </div>
  </nav>
  
  {{-- This is where the main components will be placed --}}
  <div class="container mb-5 mt-5 pt-3">
    <div class="row">
      <div class="col text-center">
        <h1> WELCOME TO OLOGRAM </h1><br>

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

      <nav>
        <div class="nav nav-pills nav-fill border border-primary rounded-3 p-3" id="nav-tab" role="tab-list" data-title="Different cases" data-intro="These are the different cases of analysis for your BED files.">
          
          @if (\Session::has('case2_show')||\Session::has('case3_show')||\Session::has('case4_show'))
            <button class="nav-link border border-primary rounded-3" id="nav-BED-GTF-tab" data-bs-toggle="tab" data-bs-target="#case1" type="button" role="tab" aria-controls="case1" aria-selected="true">BED vs GTF</button>
          @else
            <button class="nav-link border border-primary rounded-3 active" id="nav-BED-GTF-tab" data-bs-toggle="tab" data-bs-target="#case1" type="button" role="tab" aria-controls="case1" aria-selected="true">BED vs GTF</button>
          @endif

          @if (\Session::has('case2_show'))
            <button class="nav-link border border-primary rounded-3 active" id="nav-BED-GTF-keys-tab" data-bs-toggle="tab" data-bs-target="#case2" type="button" role="tab" aria-controls="case2" aria-selected="true">BED vs GTF (keys)</button>
          @else
            <button class="nav-link border border-primary rounded-3" id="nav-BED-GTF-keys-tab" data-bs-toggle="tab" data-bs-target="#case2" type="button" role="tab" aria-controls="case2" aria-selected="true">BED vs GTF (keys)</button>
          @endif

          @if (\Session::has('case3_show'))
            <button class="nav-link border border-primary rounded-3 active" id="nav-BED-BED-tab" data-bs-toggle="tab" data-bs-target="#case3" type="button" role="tab" aria-controls="case3" aria-selected="true">BED vs BED</button>        
          @else
            <button class="nav-link border border-primary rounded-3" id="nav-BED-BED-tab" data-bs-toggle="tab" data-bs-target="#case3" type="button" role="tab" aria-controls="case3" aria-selected="true">BED vs BED</button>
          @endif

          @if (\Session::has('case4_show'))
            <button class="nav-link border border-primary rounded-3 active" id="nav-BED-BED-combo-tab" data-bs-toggle="tab" data-bs-target="#case4" type="button" role="tab" aria-controls="case4" aria-selected="true">BED vs BED (combinations)</button>          
          @else
            <button class="nav-link border border-primary rounded-3" id="nav-BED-BED-combo-tab" data-bs-toggle="tab" data-bs-target="#case4" type="button" role="tab" aria-controls="case4" aria-selected="true">BED vs BED (combinations)</button>
          @endif

        </div>
    </nav>

 
    <div class="tab-content" id="nav-tabContent1">
      @if (\Session::has('case2_show')||\Session::has('case3_show')||\Session::has('case4_show'))
        <div class="tab-pane border border-primary rounded-3 fade p-3" id="case1" role="tabpanel" aria-labelledby="nav-BED-GTF-tab">
      @else 
        <div class="tab-pane border border-primary rounded-3 fade p-3 show active" id="case1" role="tabpanel" aria-labelledby="nav-BED-GTF-tab">
      @endif
            <div>
                <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm">
                    @csrf 
                    <!-- @csrf is mandatory for forms with post method -->
                    <div class="row">
                      <div class="col-sm-4 text-center">

                        <p class="fw-bold">Required options</p>
                        
                        <input type="hidden" name="caseId" value="case1">

                        <div class="input-group mb-3">
                          <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Required email address to send the final results to.">EMAIL</span>
                          <input type="email" class="form-control form-control-sm" id="email1" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                        </div>

                        <div class="input-group mb-3">
                          <input class="form-control "  id="bed1" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" data-title="BED file" data-intro="This is the BED file containing the set of regions for which the enrichment will be calculated."
                          title="BED file containing the set of regions for which the enrichment will be calculated." required>
                          <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                        </div>

                        <div class="input-group mb-3 ">  
                          <select class="form-select" aria-label="Default select example" id="ens_gtf1" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Choose reference GTF directly from Ensembl">
                              <option selected></option>
                              @foreach ($links as $link)
                              <option value="{{ $link }}" >{{ $link }}</option>
                              @endforeach
                          </select>
                          <span class="input-group-text" id="basic-addon-sp" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Choose reference GTF directly from Ensembl">Ensembl GTF + CHR</span>
                        </div>

                        <div class="input-group mb-3">
                          <input class="form-control "  id="gtf1" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                          <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">GTF</span>
                        </div>

                        {{-- <div class="progress mb-3">
                          <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}

                        <div class="input-group mb-3">
                          <input class="form-control "  id="chr1" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                          <span class="input-group-text " id="basic-addon3" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">CHR</span>
                        </div>

                        <button type="submit" class="btn btn-primary" data-title="Submit button" data-intro="Once you finished adding your files and options you can click this button to submit.">Start job</button></br><br>

                      </div>
                      
                      
                      <div class="col-sm">
                        <div class="col text-center">
                          <div class="accordion" id="case1-accordion-advanced">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading1-advanced">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1-advanced" aria-expanded="true" aria-controls="collapse1-advanced">
                                  Advanced options
                                </button>
                              </h2>

                              @if (\Session::has('case1_show'))
                              <div id="collapse1-advanced" class="accordion-collapse collapse show" aria-labelledby="heading1-advanced" data-bs-parent="#case1-accordion-advanced">
                              @else
                              <div id="collapse1-advanced" class="accordion-collapse collapse show" aria-labelledby="heading1-advanced" data-bs-parent="#case1-accordion-advanced">
                              @endif

                                <div class="accordion-body">
                                  <div class="row">
                                    <div class="col-sm-3 text-start">

                                      <div class="form-check" data-title="Test" data-intro="This is a test.">
                                        <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg1" name="fcg">
                                        <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                          Force-chrom-gtf
                                        </label>
                                      </div>

                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp1" name="fcp">
                                        <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                          Force-chrom-peak
                                        </label>
                                      </div>

                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb1" name="fcmb">
                                        <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”.">
                                          Force-chrom-more-bed
                                        </label>
                                      </div>
                                      
                                    </div>

                                    <div class="col-sm-5 text-start">

                                      <div class="input-group mb-3">
                                        <input class="form-control" type="file" id="mbed1" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features).">More BED</span>
                                      </div>

                                      <div class="input-group mb-3">
                                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting.">More BED labels</span>
                                        <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id ="mbedl1" > {{ old('mbedl') }} </textarea>
                                      </div>

                                      <div class="input-group mb-3">
                                        <input class="form-control " id="bedin1"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                      </div>

                                      <div class="input-group mb-3">
                                        <input class="form-control " id="bedex1" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “).">BED excl</span>
                                      </div>

                                    </div>

                                    <div class="col-sm text-start">

                                      <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)">Upstream</span>
                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups1" value="{{ old('ups') }}">
                                      </div>

                                      <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
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
                    </div>
                    

                  </form> 
            </div>
        </div>

    </div>

    <div class="tab-content" id="nav-tabContent2">
      @if (\Session::has('case2_show'))
        <div class="tab-pane border border-primary rounded-3 fade p-3 show active" id="case2" role="tabpanel" aria-labelledby="nav-BED-GTF-keys-tab">
      @else
        <div class="tab-pane border border-primary rounded-3 fade p-3" id="case2" role="tabpanel" aria-labelledby="nav-BED-GTF-keys-tab">
      @endif
            <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm2">
                @csrf 
                <!-- @csrf is mandatory for forms with post method -->
                <div class="row">
                  <div class="col-sm-4 text-center">

                    <p class="fw-bold">Required options</p>

                    <input type="hidden" name="caseId" value="case2">

                    <div class="input-group mb-3">
                      <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Required email address to send the final results to.">EMAIL</span>
                      <input type="email" class="form-control form-control-sm" id="email2" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control " id="bed2" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="BED file containing the set of regions for which the enrichment will be calculated." required>
                      <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                    </div>

                    <div class="input-group mb-3 ">  
                      <select class="form-select" aria-label="Default select example" id="ens_gtf2" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Choose reference GTF directly from Ensembl">
                          <option selected></option>
                          @foreach ($links as $link)
                          <option value="{{ $link }}" >{{ $link }}</option>
                          @endforeach
                      </select>
                      <span class="input-group-text" id="basic-addon-sp" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Choose reference GTF directly from Ensembl">Ensembl GTF + CHR</span>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control " id="gtf2" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">GTF</span>
                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'">GTF keys</span>
                      <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'" name="keys" id="keys">{{ old('keys') }}</textarea>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control " id="chr2" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                      <span class="input-group-text " id="basic-addon3" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">CHR</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Start job</button></br><br>

                  </div>
                  
                  
                  <div class="col-sm">
                    <div class="col text-center">
                      <div class="accordion" id="case2-accordion-advanced">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading2-advanced">
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
                                <div class="col-sm-3 text-start">

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg2" name="fcg">
                                    <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                      Force-chrom-gtf
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp2" name="fcp">
                                    <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                      Force-chrom-peak
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb2" name="fcmb">
                                    <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”.">
                                      Force-chrom-more-bed
                                    </label>
                                  </div>
                                  
                                </div>

                                <div class="col-sm-5 text-start">

                                  <div class="input-group mb-3">
                                    <input class="form-control" type="file" id="mbed2" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                    <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features).">More BED</span>
                                  </div>

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting.">More BED labels</span>
                                    <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id="mbedl2"> {{ old('mbedl') }} </textarea>
                                  </div>

                                  <div class="input-group mb-3">
                                    <input class="form-control " id="bedin2"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                    <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                  </div>

                                  <div class="input-group mb-3">
                                    <input class="form-control " id="bedex2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                    <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “).">BED excl</span>
                                  </div>

                                </div>

                                <div class="col-sm text-start">

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)">Upstream</span>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups2" value="{{ old('ups') }}">
                                  </div>

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
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
                </div>
                

              </form> 
        </div>
    </div>


    <div class="tab-content" id="nav-tabContent3">
      @if (\Session::has('case3_show'))
        <div class="tab-pane border border-primary rounded-3 fade p-3 show active" id="case3" role="tabpanel" aria-labelledby="nav-BED-BED-tab">
      @else
        <div class="tab-pane border border-primary rounded-3 fade p-3" id="case3" role="tabpanel" aria-labelledby="nav-BED-BED-tab">
      @endif
            <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm3">
                @csrf 
                <!-- @csrf is mandatory for forms with post method -->
                <div class="row">
                  <div class="col-sm-4 text-center">
                    
                    <p class="fw-bold">Required options</p>

                    <input type="hidden" name="caseId" value="case3">

                    <div class="input-group mb-3">
                      <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Required email address to send the final results to.">EMAIL</span>
                      <input type="email" class="form-control form-control-sm" id="email3" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control " id="bed3" type="file" name="bed" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="BED file containing the set of regions for which the enrichment will be calculated." required>
                      <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control" type="file" id="mbed3" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Ref BED : A list of bed files to be considered as genomic annotations.">
                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Ref BED : A list of bed files to be considered as genomic annotations.">Ref BED</span>
                    </div>

                    <div class="input-group mb-3">
                      <input class="form-control " id="chr3" type="file" name="chr" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                      <span class="input-group-text " id="basic-addon3" data-bs-toggle="tooltip" data-bs-placement="top" 
                      title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">CHR</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Start job</button></br><br>

                  </div>
                  
                  
                  <div class="col-sm">
                    <div class="col text-center">
                      <div class="accordion" id="case3-accordion-advanced">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="heading3-advanced">
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
                                <div class="col-sm-3 text-start">

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="fcg3" name="fcg">
                                    <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                      Force-chrom-gtf
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="fcp3" name="fcp">
                                    <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                      Force-chrom-peak
                                    </label>
                                  </div>

                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="fcmb3" name="fcmb">
                                    <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”.">
                                      Force-chrom-more-bed
                                    </label>
                                  </div>
                                  
                                </div>

                                <div class="col-sm-5 text-start">

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting.">More BED labels</span>
                                    <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl" id="mbedl3"> {{ old('mbedl') }} </textarea>
                                  </div>

                                  <div class="input-group mb-3">
                                    <input class="form-control " id="bedin3"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                    <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                  </div>

                                  <div class="input-group mb-3">
                                    <input class="form-control " id="bedex3" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                    <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “).">BED excl</span>
                                  </div>

                                </div>

                                <div class="col-sm text-start">

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)">Upstream</span>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" id="ups3" value="{{ old('ups') }}">
                                  </div>

                                  <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                    title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
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
                </div>
                

              </form> 
        </div>
    </div>








    <div class="tab-content" id="nav-tabContent4">
      @if (\Session::has('case4_show'))
        <div class="tab-pane border border-primary rounded-3 fade p-3 show active" id="case4" role="tabpanel" aria-labelledby="nav-BED-BED-combo-tab">
      @else
        <div class="tab-pane border border-primary rounded-3 fade p-3" id="case4" role="tabpanel" aria-labelledby="nav-BED-BED-combo-tab">
      @endif
            <div>
                <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm4">
                    @csrf 
                    <!-- @csrf is mandatory for forms with post method -->
                    <div class="row">
                      <div class="col-sm-4 text-center">

                        <p class="fw-bold">Required options</p>

                        <input type="hidden" name="caseId" value="case4">
          
                        <div class="input-group mb-3">
                          <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Required email address to send the final results to.">EMAIL</span>
                          <input type="email" class="form-control form-control-sm" id="email4" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to." required>
                        </div>

                        <div class="input-group mb-3">
                          <input class="form-control " id="bed4" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which combinations are searched." required>
                          <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="BED file containing the set of regions for which combinations are searched.">BED</span>
                        </div>

                        <div class="input-group mb-3">
                          <input class="form-control" type="file" id="mbed4" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Ref BED : A list of bed files that contains locations of  potential interactors of query.">
                          <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Ref BED : A list of bed files that contains locations of  potential interactors of query.">Ref BED</span>
                        </div>

                        <div class="input-group mb-3">
                          <input class="form-control " id="chr4" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                          <span class="input-group-text " id="basic-addon3" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">CHR</span>
                        </div>

                        <button type="submit" class="btn btn-primary">Start job</button></br><br>

                      </div>
                      
                      
                      <div class="col-sm">
                        <div class="col text-center">
                          <div class="accordion" id="case4-accordion-advanced">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="heading4-advanced">
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

                                    <div class="col-sm text-start">

                                      <div class="input-group mb-3">
                                        <input class="form-control " id="bedin4" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">
                                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                      </div>

                                      <div class="input-group mb-3">
                                        <input class="form-control " id="bedex4" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “).">BED excl</span>
                                      </div>

                                      <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned.">Max combinations</span>
                                        <input type="text" class="form-control" name="max" id="max" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned." value="{{ old('max') }}">
                                      </div>

                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" {{ old('exact') ? 'checked' : null }} id="exact" name="exact" >
                                        <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                        title="Exact : Whether to perform a transitive counting or not. For example, if true, observations of A+B+C will counts as observations of A+B. (but not as observations of A+B+D)">
                                          Exact
                                        </label>
                                      </div>



                                    </div>


                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>
                    

                  </form> 
            </div>
        </div>
    
    </div>
    
  </div>

  <nav class="navbar fixed-bottom navbar-expand-lg navbar-dark bg-light">
    
    <p class="col-md-2 mb-0 text-muted justify-content-center">© 2022 Web-OLOGRAM </p>
  
    <div class="col-md-8 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto">
  
      <a href="https://dputhier.github.io/pygtftk/ologram.html" class="link-dark text-decoration-none">
        <i class="fa-brands fa-github fa-l">OLOGRAM Docs</i>
      </a>
    </div>
  
    <p class="col-md-2 mb-0 text-muted justify-content-center">PYGTFTK v1.6.2 </p>
    
  
  </nav>

  <script type="text/javascript" src={{ asset("js/bootstrap-5.1.3.min.js") }} ></script>
  <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>
  <script type="text/javascript" src={{ asset("js/fontawesome-6.1.1.js") }}></script>
  <script type="text/javascript" src={{ asset("js/intro-5.1.0.min.js") }}></script>

  <script>
    introJs().setOption("dontShowAgain", true).setOption("skipLabel", "Skip").start();
  </script>

  <script>
    $(document).ready(function(){
      $('.nav-link').click(function(event){
        var curId = event.target.getAttribute("data-bs-target");
        $(".tab-pane").removeClass("show active");
        $(".accordion-collapse").removeClass("show");
        $(".nav-link").removeClass("active");
        $(".tab-pane" + curId).addClass("show active");
        event.target.classList.add("active");
        });
      });
  </script>

</body>

</html>
