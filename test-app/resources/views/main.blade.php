<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        OLOGRAM
    </h1>
    <br>
    <!-- this part is needed to show the success message from the routing file with post -->
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif

    <form action='/main' method='POST' >
        @csrf 
        <!-- @csrf is mandatory for forms with post method -->
        <label for='email'>email : </label>
        <input type='email' name='email'></br>
        <label for="gtf">GTF file : </label>
        <input type="file" name="gtf"></br>
        <label for="bed">BED file : </label>
        <input type="file" name="bed"></br>
        <button type='submit'>Start job</button>
        
    </form>

    
</body>
</html>
