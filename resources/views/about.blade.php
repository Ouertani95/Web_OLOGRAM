<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-icons-1.8.3/bootstrap-icons.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/custom.css") }}>

    <title>About</title>

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
              <a class="nav-link" aria-current="page" id="homeButton" href="/"><i class="bi bi-house"></i> Home</a>
            </li>
            <li class="nav-item border-end">
              <a class="nav-link active" aria-current="page" href="/about" target="_blank" rel=noopener><i class="fa-solid fa-person-chalkboard"></i> About</a>
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


    <div class="container-fluid mb-5 mt-5 pt-3">
        <div class="row">
            <div class="col-3 mt-5 ms-5 border text-center">
                <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">What is OLOGRAM ?</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Who is it for ?</a>
                    </li>
                  </ul>
            </div>
            <div class="col-8 mt-5 ms-4 border">

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
</body>
</html>