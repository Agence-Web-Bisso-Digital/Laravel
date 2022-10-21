@extends('partials.content_body')
@section('condition')
<link href="{{ asset('css/css_site/condition.css') }}" rel="stylesheet">
@endsection
@section('content')
@include('partials.navbar')
<section class="section1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3><i class="fa fa-home" aria-hidden="true"></i> Accueil/Conditions de location</h3>
            </div>
        <div class="row" id="line">
            <div class="col-md-3 form1">
                <h2>Devis express</h2>
                <form method="POST" action="{{route('devis_expres')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <select required class="form-select" name="agence" aria-label="Default select example">
                                <option selected>Choisir l'agence</option>
                                @foreach($agence as $key=>$value)
                                <option value="{{$value->id}}">{{$value->nom_agence}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Date départ</label>
                            <input required name="date" type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Heure départ</label>
                            <input required name="heure" type="time" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">Date de retour</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">Heure de retour</label>
                            <input type="time" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                    <button class="btn btn-danger w-100">Devis & Réservaton</button>
                </form>
            </div>
            <div class="col-md-8">
                <h2>Conditions générales de location</h2>
                <hr>
                <h4>preambule - solace car</h4>
                <h5>Comment puis-je réserver une voiture ?</h5>
                <ul>
                    <li>Notre système de réception des réservations est 100% en ligne, Vous pouvez prendre votre 
                    réservation via notre site web www.solacecar.com nous sommes aussi disponibles pour 
                    répondre à vos questions et vous assister au +212674070592, par e-mail 
                    solacecar@bissodigital.com
                    </li>
                </ul>
                <h5>Comment puis-je savoir si ma réservation est confirmée ?</h5>
                <ul>
                    <li>Quand vous réservez avec nous, vous recevrez d'abord un e-mail indiquant que nous avons 
                        correctement reçu votre demande de réservation. Une fois la réservation est confirmée, nous 
                        vous enverrons un e-mail pour effectuer votre paiement.<br>
                        Le temps nécessaire pour confirmer la réservation dépendra de la voiture demandée, nous avons 
                        besoin de 2 heures pour confirmer ou rejeté la réservation.<br>
                        Si vous ne recevez rien, veuillez vérifier que vous nous avez donné l’adresse e-mail correcte.<br>
                        Si vous avez fait votre réservation il y a plus de 4 heures et que vous n'avez pas reçu d'e-mail de 
                        confirmation, il est probable qu'il ait été bloqué par le filtre anti-spam de votre compte e-mail.<br>
                        Si vous n'avez pas reçu d'e-mail, veuillez nous contacter sur le site dans la partie contact.

                    </li>
                </ul>
                <h5>Mode de paiement</h5>
                <ul>
                    <li>Après la réservation de votre véhicule sur notre site, et après reception et confirmation de votre réservation par email un mode de paiement vous
                        sera précisé avec les modalités et délais nécéssaires. </li>
                </ul>
                <h5>Annulation de réservation</h5>
                <ul>
                    <li>Pour annuler votre réservation, vous avez une possibilités :<br>
                    vous avez la possibilité de contacter le service client par mail à l'adresse solacecar@bissodigital.com.
                </li>
                </ul>
               <h5>Remboursement & annulation gratuite</h5>
                <ul>
                    <li>Si vous annulez votre réservation 24 heures ou plus avant le début de la location, vous recevrez 
                    un remboursement de la somme total que vous avez payée.</li>
                </ul>
                <h5>Délai de remboursement</h5>
                <ul>
                    <li>Si votre réservation a été annulé, le montant est immédiatement reversé sur votre compte 
                    bancaire. Celui-ci peut mettre jusqu'à 10 jours ouvrés à apparaitre sur votre compte selon votre 
                    banque.<br>
                    Nous demandons en général un acompte entre 10% et 50% à l’acceptation de votre réservation 
                    par notre système, et le solde à la livraison du véhicule par carte ou en espèce (dirham)
                    </li>
                </ul>
                <h5>Partagez-le volant avec l’option "multi drivers "</h5>
                <ul>
                    <li>
                    Avec l'option "multi drivers " pour votre location de voiture au Maroc, alternez conduite et détente 
                    et dites adieu au stress et à la fatigue. Roulez en toute sérénité et cédez votre place pour 
                    découvrir le paysage.<br><br>
                    Le conducteur principal est seul assuré pour conduire nos voitures de location mais si vous 
                    souhaitez vous relayer au volant, vous pouvez ajouter autant de conducteurs additionnels que 
                    souhaités avec l’option "multi drivers " (dans la limite des places) Ils seront alors assurés au 
                    même titre que le conducteur principal et soumis aux mêmes conditions générales.

                    </li>
                </ul>
                <div class="dowload text-center">
                    <p>Télécharger nos conditions générales de location</p>
                    <a href=""><img src="{{URL::asset('css/images/file_pdf.png')}}" alt="solace car image_fichier_pdf" width="12%"></a>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        </div>
</div>
</section>
@endsection