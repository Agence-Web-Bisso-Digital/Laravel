@extends('home')
@section('style_form')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/style_form.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/modification commission</h5>
    <a href="{{route('commissions')}}"><button class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour</button></a><br><br>
            @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
                @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" enctype="multipart/form-data" action="{{route('updave_commiss',['id'=>$agence->id])}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Montant </label>
                            <input  required value="{{$agence->montant}}"  type="text" name="montant" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Pourcentage</label>
                            <input required value="{{$agence->pourcentage}}"  type="text" name="pourcentage" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="col">
                        <label for="exampleInputEmail1" class="form-label">Agence partenaire</label>
                        <input disabled value="{{$agence->id_partenaire}}"   type="text" name="agence" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                           

       
                        </div>
                    </div>
                   
                    <button class="btn btn-primary w-100"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>
                    
                    
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
   
   
  </div>
</div>
@endsection