@extends('partials.content_body')
@section('marque_vehicule')
<link href="{{ asset('css/css_site/marque_vehicule.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Réservation/Marque->{{$marque}}</h3>
            </div>
        <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    	@endif
        <h2>Location de véhicules de tourisme au Maroc</h2>
        <hr>
        @foreach($vehicule as $key=>$value)
        <div class="col-md-3">
            <div class="card">
                <img src="{{URL::asset($value->image_card)}}" alt="image véhicule"   >
                <div class="card-body">
                    <!-------------<button class="annee">{{$value->annee_creation}}</button>----------------->
                    <h5 class="card-title">{{$value->nom}}</h5>
                    <p class="prix">{{$value->prix}} MAD/Jours</p>
                    <hr>
                    <ul>
                        <li> <img src="{{URL::asset('css/images/places.png')}}" width="20" alt=""> {{$value->place}} places</li>
                        <li><img src="{{URL::asset('css/images/boite.png')}}" width="20" alt=""> {{$value->boite_vitesse}} </li>
                        <li><img src="{{URL::asset('css/images/model.png')}}" width="20" alt=""> {{$value->marque}}</li>
                    </ul>
                    <a href="{{route('vehicule_commande',['id'=>$value->id])}}" class="btn btn-primary w-100">Réserver </a>
                </div>
                </div>
            </div>
        @endforeach
        </div>
        <!------
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 carte">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.349457113896!2d-7.614867384944638!3d33.596236249070074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d282b7c663cb%3A0xe95e482a5cf0a110!2sIFIAG%20Casablanca!5e0!3m2!1sfr!2sma!4v1654015206205!5m2!1sfr!2sma" width="630" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>---->
        </div>
</div>
</section>
@endsection