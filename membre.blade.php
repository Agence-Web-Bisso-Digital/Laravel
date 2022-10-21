@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<!-- Modal1 -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Enregistrer un membre</h5>
        <button type="button" class="btn-fer" data-bs-dismiss="modal" >X</button>
      </div>
      <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{route('ajouter_membre')}}">
            @csrf
            <label for="exampleInputEmail1" class="form-label">Nom </label>
            <input required="required" type="text" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="form-label">Email </label>
            <input required="required" type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="form-label">Role </label>
            <select required="required" class="form-select" aria-label="Default select example" name="role">
                <option></option>
                <option value="membre">Membre</option>
                <option value="admin">Admin</option>
            </select>
            <label for="exampleInputEmail1" class="form-label">Mot de passe </label>
            <input required="required" type="password" name="mdp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <button type="submit" class="btn btn-primary">AJouter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/membres</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Enregistrer</button><br><br>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $key=>$value)
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->role}}</td>
                <td>{{$value->created_at}}</td>
                <td><a href="{{route('suppresion_membre',['id' => $value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                <a href="{{route('modifier_membre',['id'=>$value->id]) }}"><button type="button" data-bs-toggle="modal" data-bs-target="#update" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>    
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection