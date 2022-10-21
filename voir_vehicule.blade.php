@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/dossier véhicule</h5>
    <a href="{{route('vehicule')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
       <div class="row">
        <div class="col-md-4">
                <h1>Information sur le véhicule</h1>
                <hr>
                <ul>
                    <li>Nom  : {{$voiture->nom}}</li>
                    <li>Modèle  : {{$voiture->marque}}</li>
                    <li>Carburation  : {{$voiture->carburation}}</li>
                    <li>Boîte de vitèsse  : {{$voiture->boite_vitesse}}</li>
                    <li>Nombre de place  : {{$voiture->place}}</li>
                    <li>Kilomttrage  : {{$voiture->kilometrage}}</li>
                    <li>Année de création  : {{$voiture->annee_creation}}</li>
                </ul>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h1>Image du véhicule</h1>
                <hr>
                <img src="{{URL::asset($voiture->image_card)}}" width="70%"/>
            </div>
       </div>
    </div>
   
  </div>
</div>
@endsection