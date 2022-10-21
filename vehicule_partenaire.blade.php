@extends('home')
@section('card')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/card.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard/véhicules-partenaires</h5>
    <a href="{{route('ajout_vehicule_partenaire')}}"><button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button></a><br><br>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <table id="example" class="table table-borderless table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Agence partenaire</th>
                <th>Véhicul partenaire</th>
                @if(Auth::user()->role=="admin")
                <th>Action</th> 
                @endif
            </tr>
        </thead>
        <tbody>
           @foreach($vehicule as $key=>$value)
           <tr>
                <td>
                    <ul>
                    @foreach(explode(",",($value->id_partenaire)) as $val)
                        <li>{{$val}}</li>
                     @endforeach
                    </ul>
                </td>
                <td>

                    <ul>
                    @foreach(explode(",",($value->id_vehicule)) as $val)
                        <li>{{$val}}</li>
                    @endforeach
                    </ul>
                
                </td>
                @if(Auth::user()->role=="admin")
                <td>
                <a href="{{route('delete_vh_pt',['id'=>$value->id])}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>  
                </td> 
                
                @endif
            </tr>
           @endforeach
    </table>
   
  </div>
</div>
@endsection