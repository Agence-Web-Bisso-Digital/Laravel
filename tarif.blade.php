@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/tarifs</h5>
    <a href="{{route('ajout_tarif')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Véhicul partenaire</th>
                <th>Modèle</th>
                <th>Kilométrage</th>
                <th>Prix</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                @endif
            </tr>
        </thead>
        <tbody>
           @foreach($tarif as $key=>$value)
           <tr>
                <td>
                   {{$value->voiture->nom}}
                </td>
                <td>
                {{$value->voiture->marque}}
                </td>
                <td>
                {{$value->voiture->kilometrage}}
                </td>
                <td>
                {{$value->prix}} Dhs
                </td>
                @if(Auth::user()->role=="admin")
                <td>
                <a href="{{route('delete_tarif',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                <a href="{{route('update_tarif',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>     
              </td>
                @endif
            </tr>
         @endforeach
    </table>
   
  </div>
</div>
@endsection