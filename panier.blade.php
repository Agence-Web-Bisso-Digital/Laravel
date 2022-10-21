@extends('partials.content_body')
@section('panier')
<link href="{{ asset('css/css_site/panier.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Réservation/Panier</h3>
            </div>
        <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    	@endif
        <div class="col-md-2"></div>
        <div class="col-md-8 ">
        <table class=" table table-sm table-bordered">
    <tr class="table-active">
      <td>IMAGE</td>
      <td>PRODUIT</td>
      <td>SOUS-TOTAL</td>
    </tr>
    <tr>
      <td>
        <img src="{{URL::asset($tarif->voiture->image_card)}}" alt="image véhicule" width="100"   >
      </td>
      <td>
        <ul>
            <li>Nom véhicule : {{$tarif->voiture->nom}}</li>
            <li>Prix : {{$tarif->prix}} Dhs</li>
            <li>Quantité : {{$qt}} Jour(s)</li>
            <li>Date début : {{$date_en}}</li>
            <li>Date fin: {{$date_de}}</li>
        </ul>
      </td>
      <td>{{$montant}} Dhs</td>
    </tr>
    <tr>
        <td colspan="2" class="table-active" style="text-align: center;">TOTAL A PAYER</td>
        <td colspan="1">{{$montant}} Dhs</td>
    </tr>
    <tr>
        <td  class="table-active" style="text-align: center;">ACTIONS</td>
        <td colspan="1" style="text-align: center;"><a href="{{route('vehicules')}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a></td>
        <td colspan="2"><a href="{{route('formulaire_panier', ['id' => $tarif->id, 'date1' => $date_en, 'date2' => $date_de])}}"><button type="button" class="btn btn-primary w-100">Valider</button></a></td>
    </tr>
</table>
        </div>
        <div class="col-md-2"></div>
        
        
           
        </div>
        </div>
</div>
</section>

@endsection