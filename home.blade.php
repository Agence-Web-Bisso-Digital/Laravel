<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/style_dashboard/stylegenerale.css')}}" />
    <link rel="stylesheet" href="https://code.highcharts.com/js/highcharts.js">
    @yield('card')
    @yield('menu')
    @yield('style_form')
    @yield('style_commande')
    <title>Solace car</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://use.fontawesome.com/158065d95b.js"></script>
      <!-- lien pour mes data table menu-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <div class="d-flex" id="wrapper" style="background-color:#EEEEEE;">
        <!-- Sidebar  menu-->
                             
        <div  id="sidebar-wrapper" style="background-color:#444444  !important;">
            <div class="list-group list-group-flush my-3" >
                <nav class="sidebar" >
                <img src="{{URL::asset('css/images/logo.png')}}" alt="solace car logo" height="45" ><br>
                <hr>
                    <ul class="nav flex-column" id="nav_accordion">
                        <li class="nav-item" id="nav-item">
                            <a class="nav-link active" href="{{route('dashbord')}}"> <i  class="fa fa-tachometer fs-5 me-2" aria-hidden="true"></i>  Dashboard </a>
                        </li>
                        <li class="nav-item has-submenu">
                            <a class="nav-link dropdown-toggle " id="nav-item" href="#"> <i class="fa fa-area-chart fs-5 me-2" aria-hidden="true"></i> Gestion agences </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="{{route('agences')}}"> <i class="fa fa-balance-scale fs-5 me-2" aria-hidden="true"></i> Agences </a></li>
                                @if(Auth::user()->role=="admin")
                                <li><a class="nav-link" href="{{route('commissions')}}"> <i class="fa fa-money fs-5 me-2" aria-hidden="true"></i> Commissions </a></li>
                                @endif
                                <li><a class="nav-link" href="{{route('vehicule')}}"> <i class="fa fa-car fs-5 me-2" aria-hidden="true"></i> Véhicules  </a></li>
                                <li><a class="nav-link" href="{{route('vehicule_partenaire')}}"> <i class="fa fa-tags fs-5 me-2" aria-hidden="true"></i> Véhicules partenaires  </a></li>
                                <li><a class="nav-link" href="{{route('tarif')}}"> <i class="fa fa-list-alt fs-5 me-2" aria-hidden="true" ></i> Liste tafis  </a></li>
                                <li><a class="nav-link" href="{{route('promotion')}}"> <i class="fa fa-bullhorn fs-5 me-2" aria-hidden="true" ></i> Promotions </a></li>
                                <li><a class="nav-link" href="{{route('conducteur')}}"> <i class="fa fa-male fs-5 me-2" aria-hidden="true" ></i> Conducteurs  </a></li>
                                
                            </ul>
                        </li>
 
                        <li class="nav-item has-submenu ">
                            <a class="nav-link dropdown-toggle" id="nav-item" href="#"> <i class="fa fa-bar-chart fs-5 me-2" aria-hidden="true"></i> Gestion commande  </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="{{route('client')}}" >  <i class="fa fa-users fs-5 me-2"></i> Client </a> </li>
                                <li><a class="nav-link" href="{{route('commande')}}"> <i class="fa fa-cubes fs-5 me-2" aria-hidden="true"></i> Commandes </a></li>
                            </ul>
                        </li>
                        <li class="nav-item has-submenu ">
                            <a class="nav-link dropdown-toggle" id="nav-item" href="#"> <i class="fa fa-gg fs-5 me-2" aria-hidden="true"></i> Gestion contacts  </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="{{route('message')}}"> <i class="fa fa-commenting fs-5 me-2" aria-hidden="true"></i> Message reçu </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link dropdown-toggle" id="nav-item" href="#"> <i class="fa fa-users fs-5 me-2" aria-hidden="true"></i>Personnels  </a>
                            <ul class="submenu collapse">
                                @if(Auth::user()->role=="admin")
                                    <li><a class="nav-link" href="{{route('user')}}" > <i class="fa fa-user fs-5 me-2" aria-hidden="true"></i> Utilisateurs</a></li>       
                                    <li><a class="nav-link" href="{{ route('membre')}}" > <i class="fa fa-user fs-5 me-2" aria-hidden="true"></i> Membres</a></li>
                                @elseif(Auth::user()->role=="membre")
                                    <li><a class="nav-link" href="{{route('user')}}" > <i class="fa fa-user fs-5 me-2" aria-hidden="true"></i> Utilisateurs</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar" style="background-color:#FFFFFF ! important;  border-radius: 8px;">
               <div class="container">
                    <div class="d-flex align-items-center " >
                        <i style="color: #2487C8;" class="fa fa-bars fs-4 me-2" id="menu-toggle" aria-hidden="true"></i>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                        <ul class="navbar-nav ms-rigth mb-2 mb-lg-0">
                        <li class="nav-item dropdown" >
                            <a  style="color: #2487C8 !important;"  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->role }} {{ Auth::user()->name }}
                            </a>
                            <ul  class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item dropdown">
                                    <a style="color: #2487C8 !important;" class="dropdown-item" href="{{ route('deconnexion') }}"
                                       >
                                       <i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion
                                    </a>
                            </li>
                            <li class="nav-item dropdown">
                                    <a style="color: #2487C8 !important;" class="dropdown-item" href="{{ route('deconnexion') }}"
                                       >
                                       <i class="fa fa-user" aria-hidden="true"></i> Profile
                                    </a>
                            </li>
                            </ul>
                            </li>
                        </ul>
                    </div>
               </div>
            </nav>
           <div class='container' id="mere">
             @yield('content')
        </div>
    </div>
    <!-- lien pour mes data table 3 --->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/fonctionmenu.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
   
</body>

</html>
