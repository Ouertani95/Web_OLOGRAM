@component('mail::message')
Bonjour, 

Voici ci-joint les résultats de votre analyse avec OLOGRAM en utilisant les fichiers suivants :
@foreach ($uploaded_files_names as $file)
- {{$file}}   
@endforeach

Vous pouvez aussi les retrouver à travers ce lien :
@component('mail::button',['url'=> "$link"])
Résultats OLOGRAM
@endcomponent

Merci d'avoir choisi OLOGRAM et à bientôt !
@endcomponent
