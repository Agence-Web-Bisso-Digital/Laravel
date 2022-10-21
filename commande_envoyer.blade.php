@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/commande envoyer</h5>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Référence commande</th>
                <th>Nom client</th>
                <th>Commission</th>
                <th>Status commande</th>
                <th>Status commission</th>
                <th>Date</th>
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($com_valid as$key=>$value)
            <tr>
                <td>SOL-00C{{$value->commande->id}}</td>
                <td>{{$value->commande->client->nom}}</td>
                <td>{{$value->commission}} Dhs</td>
                <td><i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i> {{$value->status}}</td>
                <td> 
                    @if($value->statut=="Non payer")
                    {{$value->statut}} <i style="color:#F2173F" class="fa fa-times" aria-hidden="true"></i> 
                    @else
                    <i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i>  {{$value->statut}}
                    @endif   
                </td>
                <td>{{$value->created_at}}</td>
                <td><a href="{{route('delete_valid_commission',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
               @if($value->statut=="Non payer")
               <a href="{{route('valid_commission',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
               @endif
                <a href="{{route('voir_commande',['id'=>$value->commande->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a>    
            </td>
            </tr>
            @endforeach
    </table>
   
  </div>
</div>
@endsection