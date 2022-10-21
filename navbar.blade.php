
<nav id="navbar_top" class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="{{URL::asset('css/images/logo.png')}}" alt="solace car logo" height="45"  >
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i style="color:white; font-size:18px" class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link active" id="l1" aria-current="page" href="/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="l2" href="{{route('vehicules')}}">véhicules</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="l3" href="{{ route('agences1')}}">agences</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id='l4' href="{{route('condition')}}">Conditions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id='l5' href="{{ route('contact')}}">Contact</a>
        </li>
        <form class="d-flex text-center">
            <li class="nav-item">
              
                <img src="{{URL::asset('css/images/user.png')}}" alt="bisso digital logo" width="25" height="25"><br>
                <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('deconnexion') }}"
                                       >
                                        Déconnexion
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                
            </li>
        </form>
    </div>
  </div>
</nav>