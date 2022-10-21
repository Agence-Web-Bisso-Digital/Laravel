@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/commandes</h5>
    <a href="{{route('ajouter_commande')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a>
    @if(Auth::user()->role=="admin")
    <a href="{{route('commande_envoyer')}}"><button type="button" class="btn btn-info"><i class="fa fa-hourglass-end" aria-hidden="true"></i> Commande envoyer</button></a>
    @endif
    <br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Nom client</th>
                <th>Prénom client</th>
                <th>Voiture</th>
                <th>Date livraison</th>
                <th>Status</th>
                <th>Date commande</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($commande as $key=>$value)
            <tr>
                <td>{{$value->client->nom}}</td>
                <td>{{$value->client->prenom}}</td>
                <td>{{$value->tarif->voiture->nom}}</td>
                <td>{{$value->date_livraison}}</td>
                <td>
                    @if($value->statut=="Non valider")
                    <i style="color:#F2173F" class="fa fa-times" aria-hidden="true"></i>  {{$value->statut}}</td>
                    @else
                    <i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i>  {{$value->statut}}</td>
                    @endif
                   </td>
                   <td>{{$value->created_at}}</td>
                <td>
                @if(Auth::user()->role=="admin")
                <a href="{{route('delete_commande',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                <a href="{{route('voir_commande',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                @if($value->statut=="Non valider")
                <a href="{{route('valide_commande',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                @endif
                @else
                <a href="{{route('voir_commande',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
                @if($value->statut=="Non valider")
                <a href="{{route('valide_commande',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                @endif
                @endif
                
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection