@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/ajout promotion</h5>
    <a href="{{route('promotion')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a><br><br>
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
                    <form method="POST" enctype="multipart/form-data" action="{{route('save_promotion')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Prix par Jour </label>
                            <input value="{{ old('prix1') }}" required  type="text" name="prix1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Prix à partir de x jour </label>
                            <input value="{{ old('prix2') }}" required type="text" name="prix2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date début promo </label>
                            <input  required   type="date" name="date1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Date fin promo </label>
                            <input   required  type="date"  name="date2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Voiture</label>
                            <select  required  name="voiture" class="form-select" aria-label="Default select example">
                            @foreach($voiture as $key=>$value)
                            <option value="{{$value->id}}" >{{$value->nom}}</option>
                            @endforeach
                            </select> 
                        </div>
                        <div class="col">
                            <input  type="hidden" name="adresse" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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