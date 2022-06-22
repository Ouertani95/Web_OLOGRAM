<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>

    <title>live-feed</title>
</head>

@if (\Session::has('success'))
<body>
@else
<body onload = "JavaScript:AutoRefresh(5000);">
@endif
    

    {{-- This is the navigation bar on the top --}}
    <nav class="navbar navbar-light navbar-expand-lg ">
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

    <div class="container">
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
        <div class="row justify-content-md-center">
            <div class="col-sm-8 text-start">
                
                
                @if (\Session::has('success'))
                <div class="accordion" id="accordion2">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                            <strong class="text-center"> OLOGRAM command </strong> 
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#accordion2">
                            <div class="accordion-body text-center">
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" id="command" readonly>{{ $command }}</textarea>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="JavaScript:copy()">Copy command</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <strong class="text-center"> Request log </strong> 
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-break">
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
    
    <script type="text/javascript" src={{ asset("js/bootstrap-5.1.3.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>

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