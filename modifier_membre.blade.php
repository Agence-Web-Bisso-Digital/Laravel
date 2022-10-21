@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/modification membre</h5>
    <!---<a href=""><button class="btn btn-primary">Enregistrer</button></a><br><br>------------->
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form method="POST" action="{{route('update_membre')}}">
                    @csrf
                    <input value="{{$user->id}}" required="required" type="hidden" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1" class="form-label">Nom </label>
                    <input value="{{$user->name}}" required="required" type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input value="{{$user->email}}" required="required" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1" class="form-label">Role </label>
                    <select required="required" class="form-select" aria-label="Default select example" name="role">
                        @if($user->role=="admin")
                        <option value="{{$user->role}}">{{$user->role}}</option>
                        <option value="membre">Membre</option>
                        @else
                        <option value="{{$user->role}}">{{$user->role}}</option>
                        <option value="admin">Admin</option>
                        @endif   
                        
                    </select>
                    <label for="exampleInputEmail1" class="form-label">Mot de passe </label>
                    <input required="required" type="password" name="mdp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
   
   
  </div>
</div>
@endsection