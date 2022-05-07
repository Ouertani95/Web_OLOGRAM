@component('mail::message')
Bonjour, 

Voici ci-joint les résultats de votre analyse avec OLOGRAM en utilisant les fichiers suivants :
- {{$gtf}}
- {{$bed}}
- {{$chr}}

Vous pouvez aussi les retrouver à travers ce lien :
@component('mail::button',['url'=> "$link"])
Résultats OLOGRAM
@endcomponent

Merci d'avoir choisi OLOGRAM et à bientôt !
@endcomponent
