@extends('partials.content_body')
@section('vehicule')
<link href="{{ asset('css/css_site/vehicule.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Location des véhicules</h3>
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
    	        @endif
            </div>
        <div class="row">
            <div class="col-md-3 form1">
                <h2>Recherche par marque</h2>
                <form method="GET" action="search">
                    <div class="row">
                        <div class="col">
                        <select required class="form-select" aria-label="Default select example" name="q">
                            @foreach($marque as $key=>$value)
                            <option value="{{$value->marque}}">{{$value->marque}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div><br>
                    <div class="row">
                        <!---------
                        <div class="col">
                        <select required class="form-select" aria-label="Default select example">
                            @foreach($prix as $key=>$value)
                            <option value="{{$value->prix}}">{{$value->prix}} Dhs</option>
                            @endforeach
                        </select>
                        </div>------->
                    </div>
                   
                    
                    <button class="btn btn-danger w-100">Filtrer</button>
                </form>
            </div>
            <div class="col-md-8">
                <h2>Location de véhicules de tourisme au Maroc</h2>
                <hr>
                <div class="container">
                    <div class="row row-line">
                        @foreach($tarif as $key=>$value)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{URL::asset($value->voiture->image_card)}}" alt="solace car image_véhicule"   >
                                <div class="card-body">
                                    <!---<button class="annee">{{$value->voiture->annee_creation}}</button>------->
                                    <h5 class="card-title">{{$value->voiture->nom}}</h5>
                                    <p class="prix">{{$value->prix}} MAD/Jours</p>
                                    <hr>
                                    <ul>
                                        <li> <img src="{{URL::asset('css/images/places.png')}}" width="20" alt="solace car small_icon"> {{$value->voiture->place}} places</li>
                                        <li><img src="{{URL::asset('css/images/boite.png')}}" width="20" alt="solace car small_icon"> {{$value->voiture->boite_vitesse}} </li>
                                        <li><img src="{{URL::asset('css/images/model.png')}}" width="20" alt="solace car small_icon"> {{$value->voiture->marque}}</li>
                                    </ul>
                                    <a href="{{route('vehicule_commande',['id'=>$value->id])}}" class="btn btn-primary w-100">Réserver </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                      
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
        </div>
</div>
</section>
@endsection