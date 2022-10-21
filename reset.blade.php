@extends('layouts.app')
@section('email')
<link href="{{ asset('css/css_site/reset.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="section-reset">
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 formulaire">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="email" >{{ __('Email Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="password" >{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label for="password-confirm" >{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            
            <button type="submit" class="btn btn-primary">
            {{ __('Reset Password') }}
            </button>
        </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
      
</div>

@endsection
