@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/promotion</h5>
    <a href="{{route('ajout_promotion')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Montant/J</th>
                <th>Montant/*J</th>
                <th>Véhicule</th>
                <th>Status</th>
                <th>Date début</th>
                <th>Date fin</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                @endif
            </tr>
        </thead>
        <tbody>
          @foreach($promo as $key=>$value)
           <tr>
                <td>{{$value->montant_j}} Dhs</td>
                <td>{{$value->montant_jx}} Dhs</td>
                <td>{{$value->voiture->nom}}</td>
                <td>
                    @if($value->status=="Non publié")
                    <i style="color:#F2173F" class="fa fa-times" aria-hidden="true"></i> {{$value->status}}</td>
                    @else
                    <i style="color:#15BF34 " class="fa fa-check" aria-hidden="true"></i> {{$value->status}}</td>
                    @endif
                <td>{{$value->date_debut}}</td>
                <td>{{$value->date_fin}}</td>
                @if(Auth::user()->role=="admin")
                <td>
                <a href="{{route('delete_promo',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                <a href="{{route('update_promo',['id'=>$value->id])}}"><button type="button" class="btn btn-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>     
                @if($value->status=="Non publié")
                <a href="{{route('yespub_promo',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                    @else
                    <a href="{{route('nonpub_promo',['id'=>$value->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-long-arrow-down" aria-hidden="true"></i><i class="fa fa-spinner" aria-hidden="true"></i></button></a>    
                    @endif
                @else
            </td>
            @endif
            </tr>
         @endforeach
    </table>
   
  </div>
</div>
@endsection