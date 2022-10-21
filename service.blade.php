@extends('partials.content_body')
@section('condition')
<link href="{{ asset('css/css_site/service.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Nos agences de location de voitures</h3>
            </div>
        <div class="row">
            <div class="col-md-3 form1">
                <h2>Devis express</h2>
                <form method="POST" action="{{route('devis_expres')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <select required class="form-select" name="agence" aria-label="Default select example">
                                <option selected>Choisir l'agence</option>
                                @foreach($agence as $key=>$value)
                                <option value="{{$value->id}}">{{$value->nom_agence}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Date départ</label>
                            <input required name="date" type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Heure départ</label>
                            <input required name="heure" type="time" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Date de retour</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Heure de retour</label>
                            <input type="time" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <button class="btn btn-danger w-100">Devis & Réservaton</button>
                </form>
            </div>
            <div class="col-md-8">
                <h2>Faites vos réservations dans les agences solace car</h2>
                <hr>
                <div class="container">
                    <div class="row row-line">
                        <div class="col-md-5">
                            <img src="{{URL::asset('css/images/agence.jpg')}}" alt="solace car image_agency" width="100%" height="100%">
                        </div>
                        <div class="col-md-7">
                            <h5>Grovline agency</h5>
                            <p>Agence de location de voitures partenaire Solace car pour vos réservations de voitures</p>
                            <ul>
                                <li><a href="tel:+212674070592"><i class="fa fa-phone" aria-hidden="true"></i> Téléphone</a></li>
                                <li><a href="mailto:solacecar@bissodigital.com"><i class="fa fa-envelope" aria-hidden="true"></i> Adresse email</a></li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> 85 bd yassir el mani casablanca 202300</li>
                            </ul>
                            <a href="{{route('vehicules')}}"><button class="btn btn-danger">Réservation</button></a>
                        </div>
                    </div>
                    <div class="row row-line">
                        <div class="col-md-5">
                            <img src="{{URL::asset('css/images/agence.jpg')}}" alt="solace car image_agency" width="100%" height="100%">
                        </div>
                        <div class="col-md-7">
                            <h5>Grovline agency</h5>
                            <p>Agence de location de voiture partenaire Solace car pour vos réservations de voitures</p>
                            <ul>
                                <li><a href="tel:+212674070592"><i class="fa fa-phone" aria-hidden="true"></i> Téléphone</a></li>
                                <li><a href="mailto:solacecar@bissodigital.com"><i class="fa fa-envelope" aria-hidden="true"></i> Adresse email</a></li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> 85 bd yassir el mani casablanca 202300</li>
                            </ul>
                            <a href="{{route('vehicules')}}"><button class="btn btn-danger">Réservation</button></a>
                        </div>
                    </div>
                    <div class="row row-line">
                        <div class="col-md-5">
                            <img src="{{URL::asset('css/images/agence.jpg')}}" alt="solace car image_agency" width="100%" height="100%">
                        </div>
                        <div class="col-md-7">
                            <h5>Grovline agency</h5>
                            <p>Agence de location de voiture partenaire Solace car pour vos réservations de voitures</p>
                            <ul>
                                <li><a href="tel:+212674070592"><i class="fa fa-phone" aria-hidden="true"></i> Téléphone</a></li>
                                <li><a href="mailto:solacecar@bissodigital.com"><i class="fa fa-envelope" aria-hidden="true"></i> Adresse email</a></li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> 85 bd yassir el mani casablanca 202300</li>
                            </ul>
                            <a href="{{route('vehicules')}}"><button class="btn btn-danger">Réservation</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        </div>
</div>
</section>
@endsection