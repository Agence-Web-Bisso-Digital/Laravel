@extends('home')
@section('menu')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/menu.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/messages</h5>
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
                <th>Téléphone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Message</th>
                <th>Date</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($contact as $key=>$value)
            <tr>
                <td>{{$value->nom}}</td>
                <td>{{$value->prenom}}</td>
                <td>{{$value->telephone}}</td>
                <td>{{$value->email}}</td>
                <td>
                @if($value->statut=="Non traiter")
                <i style="color:#F2173F" class="fa fa-times" aria-hidden="true"></i> {{$value->statut}}
                @else
                <i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i> {{$value->statut}}
                @endif    
                </td>
                <td>{{$value->message}}</td>
                <td>{{$value->created_at}}</td>
                <td>
                @if(Auth::user()->role=="admin")
                        <a href="{{route('delete_message',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                    @if($value->statut=="Non traiter")
                    <a href="{{route('valider_message',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                    @endif
                @else
                    @if($value->statut=="Non traiter")
                        <a href="{{route('valider_message',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                        @else
                        <i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i>
                        @endif
                @endif
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection