@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/devis</h5>
    <a href=""><button class="btn btn-primary">Enregistrer</button></a><br><br>
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
                <th>Adresse</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Ardeche</td>
                <td>Ardeche</td>
                <td>Ardeche</td>
                <td>Ardeche</td>
                <td><a href=""><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                <a href="#"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>    
                <a href="#"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
            </td>
            </tr>
    </table>
   
  </div>
</div>
@endsection