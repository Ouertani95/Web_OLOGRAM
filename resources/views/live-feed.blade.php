<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
        <div class="row">
        <h1 class="text-center mb-3">OLOGRAM live-feed</h1>
        <p class="text-center">This page will refresh every 10 seconds.</p>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-sm-8 text-start border border-info">
                
                
                @foreach ($file as $line )
                    <div>{{ $line }}.</div>
                @endforeach

            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
    <script type = "text/JavaScript">
        <!--
           function AutoRefresh( t ) {
              setTimeout("location.reload(true);", t);
           }
        //-->
    </script>
    
</body>
</html>