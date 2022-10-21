@extends('partials.content_body')
@section('accueil')
<link href="{{ asset('css/css_site/accueil.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')

<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <h1>Faites votre choix</h1>
                <p>Choisissez <span id="span">solace car</span> agence de location de voitures.</p>
                <a href="{{route('vehicules')}}"><button type="button" class="btn btn-primary">réservez maintenant</button></a>
            </div>
        </div>
    </div>
</section>
<section class="section2">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form method="GET" action="search">
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">date debut</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date fin</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Marque</label>
                            <select name="q" required class="form-select" aria-label="Default select example">
                                @foreach($vt as $key=>$value)
                                <option value="{{$value->marque}}">{{$value->marque}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label"></label>
                            <button type="submit" class="btn btn-danger">Réserver</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
<section class="section3">
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <img src="{{URL::asset('css/images/full_car.png')}}" width="100%"  alt="solace car image">
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <h1>Solace car</h1>
            <p>Votre agence de location de voitures basée au Maroc pour vos réservation et vos voyages
                dans le Maroc. Plus de 60 marques de voitures à votre disposition pour vos réservation, nous
                vous accompagnons dans vos choix prestigieux et vous garentissons des véhicules bien entretenus que
                vous allez rouler en toute sécurité car votre satisfaction dans le confort est notre priorité alors
                faites vos commandes.
            </p>
            <img src="{{URL::asset('css/images/signature.png')}}" width="30%"  alt="solace car signature ">  
        </div>
        <div class="col-md-3"></div>
    </div>

</div>
</section>
<section class="section4">
    <div class="container">
        <div class="row">
            <h1>Les avantages offerts par solace car</h1>
            <p>+60 véhicules & marques</p>
            <div class="col-md-1"></div>
            <div class="col-md-3 text-center">
                <img src="{{URL::asset('css/images/service_client.png')}}" width="27%"  alt="solace car icon">  
                <p>Service client disponible 24h/7j</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 text-center">
                <img src="{{URL::asset('css/images/monney.png')}}" width="27%"  alt="solace car icon">  
                <p>Meilleur tarif sur le marché</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3 text-center">
                <img src="{{URL::asset('css/images/google_map.png')}}" width="27%"  alt="solace car icon">  
                <p>Traversez le Maroc avec nos véhicules</p>
            </div>
        </div>
    </div>
</section>
<section class="section5">
    <div class="container">
        <div class="row">
            <h1>Notre sélection</h1>
            <p>+60 véhicules & marques</p>
            <div class="col-md-1"></div>
           @foreach($selection as $key=>$value)
           <div class="col-md-3">
                <div class="card">
                    <img src="{{URL::asset($value->image_card)}}" alt="solace car voiture"   >
                    <div class="card-body">
                    <h5 class="card-title">{{$value->nom}}</h5>
                    <p class="prix"></p>
                    <hr>
                    <ul>
                    <li> <img src="{{URL::asset('css/images/places.png')}}" width="20" alt="solace car small icon"> {{$value->place}} places</li>
                    <li><img src="{{URL::asset('css/images/boite.png')}}" width="20" alt="solace car small icon">{{$value->boite_vitesse}} </li>
                    <li><img src="{{URL::asset('css/images/model.png')}}" width="20" alt="solace car small icon"> {{$value->marque}}</li>
                    </ul>
                    <a href="{{route('vehicules')}}" class="btn btn-primary w-100">Réserver </a>
                    </div>
                </div>
            </div>
           @endforeach
        </div>
    </div>
</section>
<section class="section6">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <p>Faites vos réservations dès aujourd'hui pour vos prochains trajets au +212674070592
                    opérateurs disponibles 24h/7j.
                </p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){
    
		window.addEventListener('scroll', function() {
			if (window.scrollY > 200) {
				document.getElementById('navbar_top').style.backgroundColor="#444444";
			
			} else {
                document.getElementById('navbar_top').style.backgroundColor="transparent";
      
			} 
		});
	}); 
</script>
@endsection