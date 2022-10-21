@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/conducteurs</h5>
    <a href="{{route('ajout_conducteur')}}"><button class="btn btn-primary">Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Type permis</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                @else
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($conduct as $key=>$value)
            <tr>
                <td>{{$value->nom}}</td>
                <td>{{$value->prenom}}</td>
                <td>{{$value->permis}}</td>
                <td>{{$value->telephone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->adresse}}</td>
                @if(Auth::user()->role=="admin")
                <td>    <a href="{{route('delete_conducteur',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                        <a href="{{route('update_conducteur',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>    
                </td>
                @else
                <td></td>
                @endif
            </tr>
            @endforeach
    </table>
  </div>
</div>
@endsection