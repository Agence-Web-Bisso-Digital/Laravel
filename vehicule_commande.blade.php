@extends('partials.content_body')
@section('commande_vehicule')
<link href="{{ asset('css/css_site/commande_vehicule.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Réservation véhicule</h3>
            </div>
        <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    	@endif
            <div class="col-md-1"></div>
            <div class="col-md-3" >
            <div class="card">
                <div class="card-header">
                    {{$tarif->prix}} dhs / Jour
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('valide_reservation',['id'=>$tarif->id])}}">
                        @csrf
                        <label for="exampleInputEmail1" class="form-label">Date d'enlévement</label>
                        <input name="d1" required id="d1" min="2022-07-01" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <label for="exampleInputEmail1" class="form-label">Date de dépôt</label>
                        <input name="d2" required id="d2" min="2022-07-01" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <br>
                        <button id="valider" type="submit" class="btn btn-danger w-100">réserver cette voiture</button>
                    </form>
                </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h1>{{$tarif->voiture->nom}}</h1>
                <img src="{{URL::asset($tarif->voiture->image_card)}}" alt="image véhicule" width="100%"   >
            </div>
        </div>
        </div>
</div>
</section>
<script>
 var btn=document.getElementById('valider');
 btn.addEventListener('click',f1);
 function f1(evenement){
    var d1=document.getElementById('d1').value;
    var d2=document.getElementById('d2').value;
    if(d2>d1){
        
    }
    else{
        evenement.preventDefault();
        alert('Impossible de faire cette réservation car la date d\' enlevement doit être inférieur à la date de dépôt')
    }
}
</script>
@endsection