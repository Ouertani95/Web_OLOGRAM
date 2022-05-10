<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
    
    <title>OLOGRAM test</title>

</head>
<body>

  {{-- This is the navigation bar on the top --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/main">OLOGRAM</a>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Link
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
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
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h1> WELCOME TO OLOGRAM </h1><br>

        <!-- this part is needed to show the success message from the routing file with post -->
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
        @endif
        
        <!-- show error message from redirection -->
        @if (\Session::has('error'))
        <div class="alert alert-danger alert-block">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
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
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  <h4>BED vs GTF</h4>
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <!-- This is the actual form -->
                <form action='/main' method='POST' enctype="multipart/form-data" >
                  @csrf 
                  <!-- @csrf is mandatory for forms with post method -->
                  <div class="row">
                    <div class="col-sm-4">
                    
                      <label for='email'>Email : </label>
                      <input type='email' name='email' value="{{ old('email') }}"></br><br>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroupFileAddon01">GTF</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">BED</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile02">
                          <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">CHR</span>
                        </div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile03">
                          <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary">Start job</button></br><br>

                    </div>

                    <div class="col-sm">
                      <div class="col text-center">
                        <div id="accordion-advanced">
                          <div class="card" >
                            <div class="card-header" id="headingOne-advanced" style="height: 4rem;">
                              <h5 class="s">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne-advanced" aria-expanded="false" aria-controls="collapseOne-advanced">
                                  <h6>Advanced options</h6>
                                </button>
                              </h5>
                            </div>

                            <div id="collapseOne-advanced" class="collapse" aria-labelledby="headingOne-advanced" data-parent="#accordion-advanced">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-6 text-left">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                      <label class="form-check-label" for="defaultCheck1">
                                        Force-chrom-gtf
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                      <label class="form-check-label" for="defaultCheck2">
                                        Force-chrom-peak
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                      <label class="form-check-label" for="defaultCheck3">
                                        Force-chrom-more-bed
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                      <label class="form-check-label" for="defaultCheck4">
                                        Display-fit-quality
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                      <label class="form-check-label" for="defaultCheck4">
                                        Coord-flip
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                      <label class="form-check-label" for="defaultCheck4">
                                        Hide-undef
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                      <label class="form-check-label" for="defaultCheck4">
                                        Pval-threshold
                                      </label>
                                    </div>
                                    
                                  </div>


                                  <div class="col-sm-6 text-left">
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Sort features
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item" type="button">None</button>
                                        <button class="dropdown-item" type="button">nb_intersections_expectation_shuffled</button>
                                        <button class="dropdown-item" type="button">nb_intersections_variance_shuffled</button>
                                        <button class="dropdown-item" type="button">nb_intersections_negbinom_fit_quality</button>
                                        <button class="dropdown-item" type="button">nb_intersections_log2_fold_change</button>
                                        <button class="dropdown-item" type="button">nb_intersections_true</button>
                                        <button class="dropdown-item" type="button">nb_intersections_pvalue</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_expectation_shuffled</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_variance_shuffled</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_negbinom_fit_quality</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_log2_fold_change</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_true</button>
                                        <button class="dropdown-item" type="button">summed_bp_overlaps_pvalue</button>
                                      </div>
                                    </div>
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
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h4>BED vs GTF (keys/values)</h4>
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" >
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <h4>BED vs BED</h4>                
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <h4>BED vs BED (Combinations)</h4>
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
