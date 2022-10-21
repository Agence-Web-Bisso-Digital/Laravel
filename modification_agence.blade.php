@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/modification agence</h5>
    <a href="{{route('agences')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <form method="POST" enctype="multipart/form-data" action="{{route('update_agence',['id'=>$agence->id])}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nom agence </label>
                            <input value="{{$agence->nom_agence}}" required  type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <input   type="hidden" name="id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Téléphone agence </label>
                            <input value="{{ $agence->telephone }}" required   type="text" name="telephone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Email agence </label>
                            <input value="{{ $agence->email }}"  required  type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Ville agence </label>
                            <input required value="{{ $agence->ville }}"   type="text" name="ville" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Adresse agence </label>
                            <input value="{{ $agence->adresse}}"  required  type="text" name="adresse" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Site web agence </label>
                            <input value="{{ $agence->site }}"  type="url" name="site" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nombre voiture agence </label>
                            <input value="{{ $agence->nombre_v }}" required  type="number" name="voiture" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Imge ou logo agence </label>
                            <input  type="file" name="photo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <button class="btn btn-primary w-100"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>
                    
                    
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
   
   
  </div>
</div>
@endsection