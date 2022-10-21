@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('style_commande')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_commande.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/dossier commande</h5>
    <a href="{{route('commande')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a>
    <a href="{{route('facture_pdf',['id'=>$commande->id])}}" target="_bbank"><button class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
       <div class="row">
        <h2>Référence de la commande : <b>SOL-00C{{$commande->id}}</b></h2>
        <p>Date commande :{{$commande->created_at}}</p>
        <hr>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5>Information sur l'identité client</h5><hr>
            <ul>
                <li>Nom : {{$commande->client->nom}}</li>
                <li>Prénom : {{$commande->client->prenom}}</li>
                <li>Date de naissance : {{$commande->client->date_naissance}}</li>
                <li>Téléphone  : {{$commande->client->telephone}}</li>
                <li>Email: {{$commande->client->email}}</li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5>Information postal client</h5><hr>
            <ul>
                <li>Pays : Maroc</li>
                <li>Ville: {{$commande->client->ville}}</li>
                <li>Adresse : {{$commande->client->adresse}}</li>
            </ul>
        </div>
        <div class="col-md-2"></div>
        <hr>
        </div>
        <div class="row">
        <h2>Information sur la commande</b></h2>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5>Détails de la commande</h5><hr>
            <ul>
                <li>Date enlevement : {{$commande->date_livraison}}</li>
                <li>Date rémise : {{$commande->date_remise}}</li>
                <li>Nombre jours : {{$commande->quantite}} jours</li>
                <li>Statut  : {{$commande->statut}}</li>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5>Information sur le véhicule</h5><hr>
            <ul>
                <li>Nom : {{$commande->tarif->voiture->nom}}</li>
                <li>Marque: {{$commande->tarif->voiture->marque}}</li>
                <li>Carburation : {{$commande->tarif->voiture->carburation}}</li>
                <li>kilométrage : {{$commande->tarif->voiture->kilometrage}}</li>
                <li>boîte vitesse : {{$commande->tarif->voiture->boite_vitesse}}</li>
            </ul>
        </div>
        </div>
        <div class="row">
            <h2>Détails facturation</h2>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <ul>
                    
                <li><b>Sous-total</b>: {{$commande->tarif->prix}} dhs</li>
                <li><b>Expédition</b> : forfait</li>
                <li><b>Total</b>: {{$commande->total}} dhs</li>
                </ul>
            </div>
            <div class="col-md-4"></div>
            <hr>
        </div>
   
  </div>
</div>
@endsection