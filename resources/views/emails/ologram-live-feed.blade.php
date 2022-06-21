@component('mail::message')
Hello, 

Your OLOGRAM request has been successfully submitted.

You can follow the progress at anytime through the following link:
@component('mail::button',['url'=> "$link"])
OLOGRAM live-feed
@endcomponent

Thank you for choosing OLOGRAM !
@endcomponent
