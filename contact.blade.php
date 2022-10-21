@extends('partials.content_body')
@section('contact')
<link href="{{ asset('css/css_site/contact.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Contactez-nous</h3>
            </div>
        <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    	@endif
            <div class="col-md-3 form1" >
                <h2>Devis express</h2>
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
            <div class="col-md-6">
                <h2>Contactez-nous</h2>
                <hr>
                <p>
                    Solace car est à votre disposition 24/24h  7/7j pour tous renseignements complémentaires.<br>
                    Pour nous contacter par téléphone : +212674070592.
                </p>
                <h5>Envoyez-nous un message :</h5>
                <form method="POST" action="{{ route('action_contact')}}">
                @csrf  
                 
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif 
                <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Votre prénom* </label>
                            <input required value="{{ old('prenom') }}" type="text" name="prenom" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Votre nom* </label>
                            <input  required  value="{{ old('nom') }}" type="text" name="nom" class="form-control" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Votre email* </label>
                            <input  required  value="{{ old('email') }}" type="text" name="email" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Votre téléphone*</label>
                            <input  required  value="{{ old('telephone') }}" type="text" name="telephone" class="form-control" id="exampleFormControlInput1">
                        </div>
                    </div>
                    <label for="exampleFormControlTextarea1" class="form-label">Votre message*</label>
                    <textarea  required  class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <button class="btn btn-danger w-100">Envoyer</button>
                </form>
                <br>
            </div>
            <div class="col-md-3"></div>
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