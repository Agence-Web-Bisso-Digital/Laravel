@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/utilisateurs</h5>
    <!---<a href=""><button class="btn btn-primary">Enregistrer</button></a><br><br>------------->
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                    @elseif(Auth::user()->role=="membre")
                @endif
               
               
            </tr>
        </thead>
        <tbody>
            @foreach($user as $key=>$value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->role}}</td>
                <td>{{$value->created_at}}</td>
                @if(Auth::user()->role=="admin")
                <td><a href="{{route('suppresion_user',['id' => $value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                    @elseif(Auth::user()->role=="membre")
                @endif
                <!------<a href="#"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>    
                <a href="#"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    --------------->
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection