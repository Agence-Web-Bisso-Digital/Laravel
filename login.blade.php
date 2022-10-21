@extends('layouts.app')
@section('login')
<link href="{{ asset('css/css_site/login.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 about-us text-center">
                        <h1>welcom back !</h1>
                        <p>Merci de bien vouloir vous connectez à votre compte afin de béneficier au
                         max de nos offres.</p>
                         <a href="/"><button class="btn site">Accéder au site</button></a>
                    </div>
                    <div class="col-md-4 form-left">
                    <h2>solace car</h2>
                    <form method="POST" action="{{ route('login') }}">@csrf
                        <label for="email">Adresse email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <label for="password" >Mot de passe</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                        Se souvenir de moi
                        </label><br>
                        
                        <button type="submit" class="btn btn-primary w-100">
                        Connexion
                        </button><br>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                        </a>
                        @endif
                        <p>Pas encore un compte? <a href="{{ route('register') }}">Je m'inscris</a></p>
                    </form> 
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
@endsection
