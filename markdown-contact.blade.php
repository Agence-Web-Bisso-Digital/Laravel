@component('mail::message')
Bonjour <b>M./Mme {{$data['prenom']}} {{$data['nom']}}</b><br>
Nous avons bien reçu votre message, notre équipe va vous réponde dans les brefs délais.<br><br>
Pour accéder à notre site veuillez cliquer sur le boutton.

@component('mail::button', ['url' => $url,'color'=>'success'])
Cliquez ici
@endcomponent

Merci pour  la confiance que vous nous accordez<br>
{{ config('app.name') }}
@endcomponent
