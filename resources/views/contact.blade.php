<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   

    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-icons-1.8.3/bootstrap-icons.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/custom.css") }}>

    <title>Contact</title>

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
            <a class="nav-link" aria-current="page" id="homeButton" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
              </svg> Home</a>
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
            <a class="nav-link active" aria-current="page" href="/contact" target="_blank" rel=noopener>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
              </svg> Contact</a>
          </li>
          

        </ul>
        <ul class="navbar-nav d-flex navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
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
        <div class="container mb-5 mt-5 pt-3">
            <div class="row">
                <div class="col text-center">
                    <h1 class="mt-3"> Contact us </h1><br>
                    <!-- this part is needed to show the success message from the routing file with post -->
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                            <div id="success_field">{!! \Session::get('success') !!}</div>
                    </div>
                    @endif
                </div>
            </div>
    
            <div class="row justify-content-md-center mb-3" id="issueReport">
                <div class="col-sm-8 text-center border border-dark rounded-3 p-3">
                    <form action='/contact' method='POST' enctype="multipart/form-data" id="uploadForm">
                        @csrf 
                        <!-- @csrf is mandatory for forms with post method -->
    
                        <div class="row no-gutters text-center" id="case1-required" data-title="Required options" data-intro="On the left side you have your required options.">
                          
                          
                          <div class="col text-center" >
    
                            <p class="text-start  mb-1 mt-1"><i class="bi bi-envelope"></i> Email <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                              title="Personal email address"></i></p>
                            <div class="input-group-sm mb-3 ">
                              <input type="email" class="form-control form-control-sm" id="email" name='email' value="{{ old('email') }}" placeholder="name@example.com" required>
                            </div>
    
                            <p class="text-start  mb-1 mt-1"><i class="bi bi-flag-fill"></i> Subject <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Subject of your message"></i></p>
                            <input type="text" class="form-control" placeholder="Message subject" id="subject" name="subject" value="{{ old('subject') }}" required>
                            
                            
                            <p class="text-start  mb-1 mt-1"><i class="bi bi-chat-left-dots"></i> Message <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                                title="Your personal message"></i></p>
                            <textarea class="form-control" aria-label="With textarea" placeholder="Your personal message"
                            name="message" id="message" style="height: 150px" required>{{ old('message') }}</textarea>
                            
                            <button type="submit" class="btn btn-dark btn-lg mt-3">Send message</button></br><br>
    
                          </div>
    
    
                        </div>
    
    
                        
    
                      </form>
                </div>

                <div class="col-sm-4 text-center border border-dark rounded-3 p-3">
                    <ul class="list-unstyled mb-0 mt-5">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>163, Avenue de Luminy
                                MARSEILLE cedex 09 13288 FRANCE</p>
                        </li>
        
                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+33 234 567 896</p>
                        </li>
        
                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>contact@web-ologram.com</p>
                        </li>
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
</body>
</html>