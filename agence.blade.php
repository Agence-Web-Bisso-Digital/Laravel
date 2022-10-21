@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/agences</h5>
    <a href="{{route('ajout_agence')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>ville</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($agence as $key=>$value)
            <tr>
                <td>{{$value->nom_agence}}</td>
                <td>{{$value->telephone}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->ville}}</td>
                @if(Auth::user()->role=="admin")
                <td><a href="{{route('delete_agence',['id' => $value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                    <a href="{{route('modification_agence',['id' => $value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>    
                    <a href="#"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                </td>
                    @elseif(Auth::user()->role=="membre")
                    <td>
                    <a href="#"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                    </td>
                @endif
              
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection