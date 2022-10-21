<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>solace car</title>
    <meta name="description" content="solace car agence de location de voitures basée au Maroc qui vous accompagne dans tous vos trajets au Maroc, afin de voyager en toute sécurité avec un confort idéal">
    <meta name="keywords" content="louer la voiture au Maroc, location de voiture au Maroc,louer une voiture au Maroc,comment louer la voiture au Maroc,agence de location de voiture au Maroc">
    <link rel="icon" href="{{URL::asset('css/images/flaticon.ico')}}" type="image/png">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_site/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/css_site/footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('accueil')
    @yield('contact')
    @yield('vehicule')
    @yield('condition')
    @yield('service')
    @yield('commande_vehicule')
    @yield('marque_vehicule')
    @yield('panier')
    @yield('formulaire')
</head>
<body>
    @yield('content')
    @include('partials.footer')
</body>
</html>