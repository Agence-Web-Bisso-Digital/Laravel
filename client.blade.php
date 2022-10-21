@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/clients</h5>
    <a href="{{route('ajouter_client')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
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
                <th>Datenaissance</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Adresse</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                @else<th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($client as $key=>$value)
            <tr>
                <td>{{$value->nom}}</td>
                <td>{{$value->prenom}}</td>
                <td>{{$value->date_naissance}}</td>
                <td>{{$value->telephone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->ville}}</td>
                <td>{{$value->adresse}}</td>
                @if(Auth::user()->role=="admin")
                <td><a href="{{route('delete_client',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                @else
                <td></td>
                @endif
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection