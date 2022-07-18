<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">   

  <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
  <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-icons-1.8.3/bootstrap-icons.css") }}>
  <link rel="stylesheet" type="text/css" href={{ asset("css/custom.css") }}>

    <title>live-feed</title>
</head>

@if (\Session::has('success'))
<body>
@else
<body onload = "JavaScript:AutoRefresh(5000);">
@endif
    

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
            <a class="nav-link" aria-current="page" id="homeButton" href="/"><i class="bi bi-house"></i> Home</a>
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
            <a class="btn btn-danger" aria-current="page" id="reportButton" href="/issue" target="_blank" rel=noopener><i class="bi bi-bug-fill"></i> Report issue</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

    <div class="container mb-5 mt-5 pt-3">
        <div class="row justify-content-md-center">
            <div class="col-sm-8 text-start text-center">
                <h1 class="text-center mb-3">OLOGRAM live-feed</h1>

                @if (!\Session::has('success'))
                <p class="text-center">This page will refresh every 5 seconds.</p>
                @endif


                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li id="success_field"> <strong>Your results are ready !</strong> </li>
                    </ul>
                    <a class="btn btn-success " href="{!! \Session::get('success') !!}" role="button" target="_blank" rel=noopener>OLOGRAM Results</a>
                </div>

                @elseif (\Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <ul>
                        <li id="error_field"> <strong> {!! \Session::get('error') !!}</strong></li>
                    </ul>
                </div>

                @elseif (\Session::has('queue'))
                <div class="alert alert-primary alert-block">
                    <ul>
                        <li id="queue_field"> <strong> {!! \Session::get('queue') !!}</strong></li>
                    </ul>
                </div>

                @elseif (\Session::has('running'))
                <div class="alert alert-dark" role="alert">
                    <div class="d-flex align-items-center">
                        <strong>Your request is running ... </strong>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>                  
                @endif
            </div>
        </div>

        <div class="row justify-content-md-center mb-3">
            <div class="col-sm-8 text-center">
                
                
                @if (\Session::has('success'))
                <div class="accordion" id="accordion2">
                    <div class="accordion-item justify-content-md-center">
                        <h2 class="accordion-header border border-dark rounded-3" id="heading2">
                            <button class="accordion-button d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                               <strong class="text-center"> OLOGRAM command </strong> 
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#accordion2">
                            <div class="accordion-body text-center border border-dark rounded-3">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" id="command" readonly>{{ $command }}</textarea>
                                    <button class="btn btn-success" type="button" id="button-addon1" onclick="JavaScript:copy()">Copy command</button>
                                </div>

                                @if (\Session::has('download'))
                                <a class="btn btn-success mb-3" href="{!! \Session::get('download') !!}" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                    </svg>
                                    Download Ensembl GTF + CHR
                                </a>
                        @endif
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                @endif

            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-sm-8 text-start">

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header border border-dark rounded-3" id="headingOne">
                            <button class="accordion-button d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <strong class="text-center"> Request log </strong> 
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-break text-start border border-dark rounded-3">
                                @foreach ($file as $line )
                                    <div>{{ $line }}</div>
                                @endforeach
                            </div>
                        </div>
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
    <script type = "text/JavaScript">
        function AutoRefresh( t ) {
            setTimeout("location.reload(true);", t);
        }
        function copy() {
            var content = document.getElementById('command');
    
            content.select();
            document.execCommand('copy');

            alert("Copied!");
        } 
    </script>
    
</body>
</html>