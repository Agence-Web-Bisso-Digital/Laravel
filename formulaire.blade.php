@extends('partials.content_body')
@section('formulaire')
<link href="{{ asset('css/css_site/formulaire.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Détail facturation</h3>
            </div>
        <div class="row">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    	@endif
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="{{route('traitement_formulaire', ['id' => $id, 'date1' => $date1, 'date2' => $date2])}}">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Nom *</label>
                        <input type="text" required name="nom" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Prénom *</label>
                        <input type="text" required name="prenom" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Date de naissance *</label>
                        <input max="2002-01-01" required name="date" type="date" class="form-control" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Ville *</label>
                        <input type="ville" required name="ville" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Adresse *</label>
                        <input type="text" required name="adresse" class="form-control" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Téléphone *</label>
                        <input type="text" required name="telephone" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Email *</label>
                        <input type="email" required name="email" class="form-control" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlTextarea1" class="form-label">Note sur la commande (faculatif)</label>
                        <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-danger w-100">Valider</button>
            </form>
        </div>
        <div class="col-md-2"></div>
            
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