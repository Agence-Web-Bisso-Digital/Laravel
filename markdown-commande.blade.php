@component('mail::message')
Bonjour,<br>
Nous avons le plaisir de vous confirmer la validation de votre
réservation.<br><br>
Celle-ci vous sera validée dans les meilleurs délais et vous recevrez un e-mail
dès qu'elle sera validée.<br><br>
Vous pouvez, dès à présent, retourner sur le site en cliquant sur le boutton.

@component('mail::button', ['url' => $url,'color'=>'success'])
Cliquez ici
@endcomponent

Merci pour votre réservation et la confiance que vous nous accordez.<br>
L'équipe solace car<br><br>
{{ config('app.name') }}
@endcomponent
