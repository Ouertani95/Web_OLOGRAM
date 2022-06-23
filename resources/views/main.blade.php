<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
    
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

    <div class="row">
      <div class="col text-center">
        <div class="accordion" id="cases-accordion">

          {{-- Case 1 accordion item --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                BED vs GTF
              </button>
            </h2>

            @if (\Session::has('case1_show'))
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#cases-accordion">
            @else
            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#cases-accordion">
            @endif

              <div class="accordion-body">
                <!-- This is the actual form -->
                <form action='/' method='POST' enctype="multipart/form-data" id="uploadForm">
                  @csrf 
                  <!-- @csrf is mandatory for forms with post method -->
                  <div class="row">
                    <div class="col-sm-4 ">
                      
                      <input type="hidden" name="caseId" value="case1">

                      <div class="input-group mb-3">
                        <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Required email address to send the final results to.">EMAIL</span>
                        <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                         data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to.">
                      </div>

                      <div class="input-group mb-3 ">  
                        <select class="form-select" aria-label="Default select example" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Choose reference GTF directly from Ensembl">
                            <option selected></option>
                            @foreach ($links as $link)
                            <option value="{{ $link }}" >{{ $link }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text" id="basic-addon-sp" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Choose reference GTF directly from Ensembl">Ensembl GTF</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control "  id="gtf" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">GTF</span>
                      </div>

                      <div class="progress mb-3">
                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      

                      <div class="input-group mb-3">
                        <input class="form-control "  name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">
                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control "  name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">
                        <span class="input-group-text " id="basic-addon3" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Chromosome sizes ; Tabulated two-columns file. Chromosomes as column 1, sizes as column 2.">CHR</span>
                      </div>

                      <button type="submit" class="btn btn-primary">Start job</button></br><br>

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
                            <div id="collapse1-advanced" class="accordion-collapse collapse " aria-labelledby="heading1-advanced" data-bs-parent="#case1-accordion-advanced">
                            @endif

                              <div class="accordion-body">
                                <div class="row">
                                  <div class="col-sm-3 text-start">

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="defaultCheck1" name="fcg">
                                      <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                        Force-chrom-gtf
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="defaultCheck2" name="fcp">
                                      <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                        Force-chrom-peak
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="defaultCheck3" name="fcmb">
                                      <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”.">
                                        Force-chrom-more-bed
                                      </label>
                                    </div>
                                    
                                  </div>

                                  <div class="col-sm-5 text-start">

                                    <div class="input-group mb-3">
                                      <input class="form-control" type="file" id="formFileMultiple" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features).">More BED</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting.">More BED labels</span>
                                      <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl"> {{ old('mbedl') }} </textarea>
                                    </div>

                                     <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm1"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" value="{{ old('ups') }}">
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" value="{{ old('dns') }}">
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

          {{-- Case 2 accordion item --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                BED vs GTF (keys/values)
              </button>
            </h2>

            @if (\Session::has('case2_show'))
            <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#cases-accordion">
            @else
            <div id="collapse2" class="accordion-collapse collapse " aria-labelledby="heading2" data-bs-parent="#cases-accordion">
            @endif
            
              <div class="accordion-body">
                <!-- This is the actual form -->
                <form action='/' method='POST' enctype="multipart/form-data" >
                  @csrf 
                  <!-- @csrf is mandatory for forms with post method -->
                  <div class="row">
                    <div class="col-sm-4 ">

                      <input type="hidden" name="caseId" value="case2">

                      <div class="input-group mb-3">
                        <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Required email address to send the final results to.">EMAIL</span>
                        <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" name='email' value="{{ old('email') }}" placeholder="name@example.com"
                         data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to.">
                      </div>

                      <div class="input-group mb-3 ">  
                        <select class="form-select" aria-label="Default select example" name="ens_gtf" value="{{ old("ens_gtf") }}" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Choose reference GTF directly from Ensembl">
                            <option selected></option>
                            @foreach ($links as $link)
                            <option value="{{ $link }}" >{{ $link }}</option>
                            @endforeach
                        </select>
                        <span class="input-group-text" id="basic-addon-sp" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Choose reference GTF directly from Ensembl">Ensembl GTF</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm1" name="gtf" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="The GTF file of interest. Enrichment of the query will be calculated against the features it describes (e.g. exon, transcript, promoter…).">GTF</span>
                      </div>

                      <div class="input-group mb-3">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'">GTF keys</span>
                        <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="GTF keys : A comma separated list of GTF keys used for annoting the genome Default: 'gene_biotype'" name="keys">{{ old('keys') }}</textarea>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm2" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">
                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm3" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="defaultCheck1" name="fcg">
                                      <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                        Force-chrom-gtf
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="defaultCheck2" name="fcp">
                                      <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                        Force-chrom-peak
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="defaultCheck3" name="fcmb">
                                      <label class="form-check-label" for="defaultCheck3" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Force-chrom-more-bed : Discard silently, from --more-bed files, regions outside chromosomes defined “Chromosome sizes”.">
                                        Force-chrom-more-bed
                                      </label>
                                    </div>
                                    
                                  </div>

                                  <div class="col-sm-5 text-start">

                                    <div class="input-group mb-3">
                                      <input class="form-control" type="file" id="formFileMultiple" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features)." name="mbed[]">
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED : A list of bed files to be considered as additional reference annotations (i.e in addition to gene centric features).">More BED</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting.">More BED labels</span>
                                      <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl"> {{ old('mbedl') }} </textarea>
                                    </div>

                                    <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm1"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" value="{{ old('ups') }}">
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" value="{{ old('dns') }}">
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

          {{-- Case 3 accordion item --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                BED vs BED
              </button>
            </h2>

            @if (\Session::has('case3_show'))
            <div id="collapse3" class="accordion-collapse collapse show" aria-labelledby="heading3" data-bs-parent="#cases-accordion">
            @else
            <div id="collapse3" class="accordion-collapse collapse " aria-labelledby="heading3" data-bs-parent="#cases-accordion">
            @endif
            
              <div class="accordion-body">
                <!-- This is the actual form -->
                <form action='/' method='POST' enctype="multipart/form-data" >
                  @csrf 
                  <!-- @csrf is mandatory for forms with post method -->
                  <div class="row">
                    <div class="col-sm-4 ">
                      
                      <input type="hidden" name="caseId" value="case3">

                      <div class="input-group mb-3">
                        <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Required email address to send the final results to.">EMAIL</span>
                        <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                         data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to.">
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control" type="file" id="formFileMultiple" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Ref BED : A list of bed files to be considered as genomic annotations.">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Ref BED : A list of bed files to be considered as genomic annotations.">Ref BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm2" type="file" name="bed" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">
                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which the enrichment will be calculated.">BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm3" type="file" name="chr" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcg') ? 'checked' : null }} id="defaultCheck1" name="fcg">
                                      <label class="form-check-label" for="defaultCheck1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title=" Force-chrom-gtf : Discard silently, from GTF, genes outside chromosomes defined in “Chromosome sizes” file.">
                                        Force-chrom-gtf
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcp') ? 'checked' : null }} id="defaultCheck2" name="fcp">
                                      <label class="form-check-label" for="defaultCheck2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Force-chrom-peak : Discard silently, from query regions file, regions outside chromosomes defined in “Chromosome sizes”.">
                                        Force-chrom-peak
                                      </label>
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('fcmb') ? 'checked' : null }} id="defaultCheck3" name="fcmb">
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
                                      title="More BED labels : A comma separated list of labels for “Additional Reference regions”. Used for plotting." name="mbedl"> {{ old('mbedl') }} </textarea>
                                    </div>

                                     <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm1"  type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">  
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      title="Upstream : Extend the TSS and TTS of in 5' by a given value. (default: 1000)" name="ups" value="{{ old('ups') }}">
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)">Downstream</span>
                                      <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Downstream : Extend the TSS and TTS of in 3' by a given value. (default: 1000)" name="dns" value="{{ old('dns') }}">
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

          {{-- Case 4 accordion item --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                BED vs BED (Combinations)
              </button>
            </h2>

            @if (\Session::has('case4_show'))
            <div id="collapse4" class="accordion-collapse collapse show" aria-labelledby="heading4" data-bs-parent="#cases-accordion">
            @else
            <div id="collapse4" class="accordion-collapse collapse " aria-labelledby="heading4" data-bs-parent="#cases-accordion">
            @endif

              <div class="accordion-body">
                <!-- This is the actual form -->
                <form action='/' method='POST' enctype="multipart/form-data" >
                  @csrf 
                  <!-- @csrf is mandatory for forms with post method -->
                  <div class="row">
                    <div class="col-sm-4 ">

                      <input type="hidden" name="caseId" value="case4">
        
                      <div class="input-group mb-3">
                        <span class="input-group-text " id="basic-addon0" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Required email address to send the final results to.">EMAIL</span>
                        <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                         data-bs-toggle="tooltip" data-bs-placement="top" title="Required email address to send the final results to.">
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control" type="file" id="formFileMultiple" name="mbed[]" multiple data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Ref BED : A list of bed files that contains locations of  potential interactors of query.">
                        <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="Ref BED : A list of bed files that contains locations of  potential interactors of query.">Ref BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm2" name="bed" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which combinations are searched.">
                        <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                        title="BED file containing the set of regions for which combinations are searched.">BED</span>
                      </div>

                      <div class="input-group mb-3">
                        <input class="form-control " id="formFileSm3" name="chr" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
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
                                      <input class="form-control " id="formFileSm1" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “)." name="bedin">
                                      <span class="input-group-text" id="basic-addon1" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED incl : A BED file. Only these regions will be considered for analysis (opposite of “Exclusion file “).">BED incl</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <input class="form-control " id="formFileSm2" type="file" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “)." name="bedex">
                                      <span class="input-group-text " id="basic-addon2" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="BED excl : A BED file. These regions will not be considered for analysis (opposite of “Restriction file “).">BED excl</span>
                                    </div>

                                    <div class="input-group mb-3">
                                      <span class="input-group-text" id="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned.">Max combinations</span>
                                      <input type="text" class="form-control" name="max" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" data-bs-toggle="tooltip" data-bs-placement="top" 
                                      title="Max combinations : Maximum number of combinations to consider by applying the MODL algorithm to the matrix of full overlaps. Defaults to -1, which means MODL is NOT applied and all combinations are returned." value="{{ old('max') }}">
                                    </div>

                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="1" {{ old('exact') ? 'checked' : null }} id="defaultCheck3" name="exact" >
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
      </div>
    </div>
  </div>


  <script type="text/javascript" src={{ asset("js/bootstrap-5.1.3.min.js") }} ></script>
  <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>

  <script type="text/javascript">
    $(document).ready(function (e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#uploadForm').submit(function(e) {
        e.preventDefault();
        // var form = $("#Form");
        var formData = new FormData(this);
        var $this = $(this);
        $.ajax(
          xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round(((evt.loaded / evt.total) * 100)) ;
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete+'%');
                        }
                    }, false);
                    return xhr;
            },
            type:'POST',
            url: "",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
            this.reset();
            alert('File has been uploaded successfully');
            console.log(data);
            },
            error: function(data){
              error: function (xhr) {
                $('#error_field').html('');
                $.each(xhr.responseJSON.errors, function(key,value) {
                  $('#error_field').append('<div class="alert alert-danger">'+value+'</div');
                }); 
              };
              console.log(data);
            });
        }); 
      });
  </script>
</body>
</html>
