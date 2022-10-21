@extends('home')
@section('menu')
<link rel="stylesheet" href="{{ asset('css/style_dashboard/menu.css')}}" />
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Dashboard</h5>
    @if(session()->has('status'))
        <div class="alert alert-success">
                        {{ session()->get('status') }}
        </div>
    @endif
    <div class="container">
      <div class="row">
        <div class="col-md-2">
        <div class="card a">
          <i class="fa fa-car " aria-hidden="true"></i>
            <div class="card-body">
              <h5 class="card-title">Total : {{$voiture}}
              </h5>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
          <div class="card b">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <div class="card-body">
              <h5 class="card-title">Total : {{$commande}}</h5>
             
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
        <div class="card c">
        <i class="fa fa-users" aria-hidden="true"></i>
            <div class="card-body">
              <h5 class="card-title">Total : {{$user}}</h5>
             
            </div>
          </div>
        </div>
        
        <div class="col-md-1"></div>
        <div class="col-md-2">
        <div class="card d">
            <i class="fa fa-commenting " aria-hidden="true"></i>
            <div class="card-body">
              <h5 class="card-title">Total : {{$contact}}</h5>
             
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div><br>
    <div class="container">
      <div class="row">
        <div class="col-md-12" id="container">

        </div>
      </div>
    </div>
   
  </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="module">
   import Highcharts from 'https://code.highcharts.com/es-modules/masters/highcharts.src.js';
  var userData=<?php echo json_encode($grap)?>;
  Highcharts.chart('container',{
    title:{
      text:"Graphe d'évolution des commandes"
    },
    xAxis:{
      categories :['Janvier','Fevrier','Mars',' Avril','Mai','Juin',
'Juillet','Aôut','Septembre','Octobre','Novembre','Decembre']
    },
    yAxis:{
      title:{
        text:"Nombre des nouveuax commandes"
      }
    },
    series:[
      {
        name:"Nouveau commande",
        data:userData
      }
    ]
  });
</script>
@endsection