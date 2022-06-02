@component('mail::message')
Hello, 

Your OLOGRAM request has been successfully completed using the following files:
@foreach ($uploaded_files_names as $file)
@if (is_array($file))
@foreach ($file as $subfile)
- {{$subfile}}
@endforeach
@else
- {{$file}}
@endif
@endforeach

You can find your results through the following link:
@component('mail::button',['url'=> "$link"])
OLOGRAM results
@endcomponent

Thank you for choosing OLOGRAM and see you soon!
@endcomponent
