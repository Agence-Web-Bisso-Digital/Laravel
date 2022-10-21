@extends('layouts.app')
@section('email')
<link href="{{ asset('css/css_site/email.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="section-login">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4 about-us text-center">
                        <h1>Forgot password ?</h1>
                        <p>Merci de bien vouloir inscrire votre adresse email fournie lors de l'inscription 
                         afin de pouvoir réinitialisé votre mot de passe</p>
                         <a href="/"><button class="btn site">Accéder au site</button></a>
                    </div>
                    <div class="col-md-4 form-left">
                    <h2>solace car</h2>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <label for="email" >{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary w-100">
                    Envoyer
                    </button>
                    </div>
                    </div>
                    </form> 
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
@endsection

