<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href={{ asset("css/bootstrap-5.1.3.min.css") }}>

    <title>live-feed</title>
</head>
<body onload = "JavaScript:AutoRefresh(10000);">
    

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
                <p class="text-center">This page will refresh every 10 seconds.</p>

                {{-- @if (\Session::has('success'))
                <a class="btn btn-success" href="{!! \Session::get('success') !!}" role="button" target="_blank" rel=noopener>OLOGRAM Results</a>
                @endif --}}
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li id="success_field">Your results are ready !</li>
                    </ul>
                    <a class="btn btn-success " href="{!! \Session::get('success') !!}" role="button" target="_blank" rel=noopener>OLOGRAM Results</a>
                </div>
                @endif

                @if (\Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <ul>
                        <li id="error_field">{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-sm-8 text-start border border-info">
                
                
                @foreach ($file as $line )
                    <div>{{ $line }}.</div>
                @endforeach

            </div>
        </div>
    </div>
    
    <script type="text/javascript" src={{ asset("js/bootstrap-5.1.3.min.js") }} ></script>
    <script type="text/javascript" src={{ asset("js/jquery-3.6.0.min.js") }}></script>

    <script type = "text/JavaScript">
        function AutoRefresh( t ) {
            setTimeout("location.reload(true);", t);
        }
    </script>
    
</body>
</html>