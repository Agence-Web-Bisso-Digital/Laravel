@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/ajout véhicule</h5>
    <a href="{{route('vehicule')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a><br><br>
            @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
                @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" enctype="multipart/form-data" action="{{route('save_vehicule')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nom véhicule </label>
                            <input value="{{ old('nom') }}" required  type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Modèle véhicule </label>
                            <input value="{{ old('modele') }}" required  type="texte" name="modele" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Type de carburation </label>
                            <select  required name="carburant" class="form-select" aria-label="Default select example">
                                <option ></option>
                                <option value="Essence">Essence</option>
                                <option value="Gasoil">Gasoil</option>
                                <option value="Autres">Autres</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Boîte de vitèsse</label>
                            <select  required  name="boite" class="form-select" aria-label="Default select example">
                                <option ></option>
                                <option value="Automatique">Automatique</option>
                                <option value="Manuelle">Manuelle</option>
                                <option value="Séquentielle">Séquentielle</option>
                                <option value="Robotisée">Robotisée</option>
                                <option value="Double embrayage">Double embrayage</option>
                            </select>                        
                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Nombre de place </label>
                            <input required value="{{ old('place') }}"   type="number" name="place" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Kilométrage véhicule</label>
                            <input value="{{ old('kilometre') }}"  required  type="text" name="kilometre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date création</label>
                            <input  required value="{{ old('date') }}"  type="date" name="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Imge véhicule</label>
                            <input value="{{ old('photo') }}" required  type="file" name="photo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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