<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    
        <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-icons-1.8.3/bootstrap-icons.css") }}>
        <style>
          /*Code to change color of active link*/
          .nav-link.border.active {
                background-color: #212529;
            }
          .nav-link.border {
                color: black;
          }
          .nav-link.border:hover {
                color: salmon;
            }
          .btn:hover {
                color: salmon;
            }
          .bi.bi-info-circle:hover {
                color: salmon;
            }
            .bi.bi-info-circle {
                color:teal;
            }
          
      </style>
    
        <title>Issue report</title>
    
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
              <a class="nav-link" aria-current="page" href="/"><i class="bi bi-house"></i> Home</a>
            </li>
            <li class="nav-item border-end">
              <a class="nav-link" aria-current="page" href="/about" target="_blank" rel=noopener><i class="fa-solid fa-person-chalkboard"></i> About</a>
            </li>
            <li class="nav-item dropdown border-end">
              <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-book"></i> Documentation
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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

    {{-- This is where the main components will be placed --}}
    <div class="container mb-5 mt-5 pt-3">
        <div class="row">
            <div class="col text-center">
                <h1 class="mt-3"> Report issue </h1><br>
                <!-- this part is needed to show the success message from the routing file with post -->
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li id="success_field">{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-md-center mb-3" id="issueReport">
            <div class="col-sm-8 text-center border border-dark rounded-3 p-3">
                <form action='/issue' method='POST' enctype="multipart/form-data" id="uploadForm">
                    @csrf 
                    <!-- @csrf is mandatory for forms with post method -->

                    <input type="hidden" name="caseId" value="issue">

                    <div class="row no-gutters text-center" id="case1-required" data-title="Required options" data-intro="On the left side you have your required options.">
                      
                      
                      <div class="col text-center" >

                        <p class="text-start  mb-1 mt-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                          title="Personal email address for contact about issue"></i></p>

                        <div class="input-group-sm mb-3 ">
                          <input type="email" class="form-control form-control-sm" id="email" name='email' value="{{ old('email') }}" placeholder="name@example.com" required>
                        </div>

                        <p class="text-start  mb-1 mt-1"><i class="bi bi-flag-fill"></i> Title <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Encountered issue title"></i></p>
                        <input type="text" class="form-control" placeholder="Issue title" id="title" name="title" value="{{ old('title') }}" required>
                        
                        
                        <p class="text-start  mb-1 mt-1"><i class="bi bi-bug-fill"></i></i> Description <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                            title="Detailed description of the issue encountered"></i></p>
                        <textarea class="form-control" aria-label="With textarea" data-bs-toggle="tooltip" data-bs-placement="top" placeholder="Brief description"
                        title="Brief description of the issue encountered" name="description" id="description" style="height: 150px" required>{{ old('description') }}</textarea>
                        
                        <button type="submit" class="btn btn-dark btn-lg mt-3">Submit report</button></br><br>

                      </div>


                    </div>


                    

                  </form>
            </div>

        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-expand-lg navbar-light bg-light">

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


    <script type="text/javascript" src={{ asset("js/bootstrap.bundle-5.1.3.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>
    <script type="text/javascript" src={{ asset("js/fontawesome-6.1.1.js") }}></script>
</body>
</html>