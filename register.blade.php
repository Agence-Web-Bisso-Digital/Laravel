@extends('layouts.app')
@section('register')
<link href="{{ asset('css/css_site/register.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 about-us text-center">
                        <h1>you are welcome!</h1>
                        <p>Merci de bien vouloir vous inscrire afin de ne rater aucune de nos nouvelles.</p>
                         <a href="/"><button class="btn site">Accéder au site</button></a>
                    </div>
                    <div class="col-md-4 form-left">
                    <h2>solace car</h2>
                    <form method="POST" action="{{ route('register') }}">
@csrf
<label for="name">Nom</label>
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
 @enderror
<label for="email">Adresse email</label>
<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="password">Mot de passe</label>
<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
@error('password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="password-confirm">Confirmation mot de passe</label>
<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
<button type="submit" class="btn btn-primary w-100">
Inscription
</button>
<p>Déjà un compte? <a href="{{ route('login') }}">Connexion</a></p>
</form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
@endsection
