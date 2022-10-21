<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture-commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .p{
        text-align: center;
       font-size: 14px;
       color: #2487C8;
       text-transform: uppercase;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <p class="p">Réference de la commande : sol-00c{{$id}}</p>
            <p class="p">Date commande : {{$dco}}</p>
            <hr>
            <div class="col-md-1"></div>
        <div class="col-md-4">
            <p class="para">Informations sur l'identité client</p><hr>
            <ul>
                <li>Nom : {{$nom}}</li>
                <li>Prénom : {{$prenom}}</li>
                <li>Date de naissance : {{$date}}</li>
                <li>Téléphone  : {{$telephone}}</li>
                <li>Email: {{$email}}</li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <p class="para">Informations postals client</p><hr>
            <ul>
                <li>Pays : Maroc</li>
                <li>Ville: {{$ville}}</li>
                <li>Adresse : {{$adresse}}</li>
            </ul>
        </div>
        <div class="col-md-2"></div>
        <hr>
        </div>
        <div class="row">
        <p class="p">Informations sur la commande</b></h2>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <p class="para">Détails de la commande</p><hr>
            <ul>
                <li>Date enlevement : {{$date_livraison}}</li>
                <li>Date rémise : {{$date_remise}}</li>
                <li>Nombre jours : {{$quantite}} jours</li>
                <li>Statut  : {{$statut}}</li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <p class="para">Informations sur le véhicule</p><hr>
            <ul>
                <li>Nom : {{$nomv}}</li>
                <li>Marque: {{$marquev}}</li>
                <li>Carburation : {{$carburationv}}</li>
                <li>kilométrage : {{$kilometragev}}</li>
                <li>boîte vitesse : {{$boite_vitessev}}</li>
            </ul>
        </div>
        </div>
        <div class="row">
            <p class="p">Détails facturation</p>
            <hr>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <ul>
                <li><b>Sous-total</b>: {{$prix}} Dhs</li>
                <li><b>Expédition</b> : forfait</li>
                <li><b>Total</b>: {{$total}} Dhs</li>
                </ul>
            </div>
            <div class="col-md-4">
            </div>
            <hr>
           
        </div>
    </div>
</body>
</html>