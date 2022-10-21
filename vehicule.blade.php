@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/véhicules</h5>
    <a href="{{route('ajout_vehicule')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Model</th>
                <th>Carburation</th>
                <th>Boîte vitesse</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
           @foreach($voiture as $key=>$value)
           <tr>
                <td>{{$value->nom}}</td>
                <td>{{$value->marque}}</td>
                <td>{{$value->carburation}}</td>
                <td>{{$value->boite_vitesse}}</td>
                <td>
                @if(Auth::user()->role=="admin")
                <a href="{{route('delete_vehicule',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                <a href="{{route('voir_vehicule',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                 @else<a href="{{route('voir_vehicule',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                @endif
               
            </td>
            </tr>
           @endforeach
    </table>
   
  </div>
</div>
@endsection