<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MembreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $vt = DB::table('vehicules')->select('marque')->distinct()->get();
    $selection = DB::table('vehicules')->limit(3)->get();
    return view('../components/accueil',compact('vt','selection'));
});
//pour lemail
Route::get('/mail',[PostController::class,'mail']);
//
Route::get('/nos-vehicules',[PostController::class,'vehicules'])->name('vehicules');
Route::get('/nos-agences',[PostController::class,'agences1'])->name('agences1');
Route::get('/condition-general',[PostController::class,'condition'])->name('condition');
Route::get('/politique-confidentialite',[PostController::class,'politique'])->name('politique');
Route::get('/mentions-legales',[PostController::class,'mentions'])->name('mentions');
Route::get('/contacter-nous',[PostController::class,'contact'])->name('contact');
Route::post('enregistrer-contact',[PostController::class,'action_contact'])->name('action_contact');
Route::post('/devis-express',[PostController::class,'devis_expres'])->name('devis_expres');
Route::get('/devis-exprex',[PostController::class,'all_vehicule'])->name('all_vehicule');
Route::get('/vehicule-commande/{id}',[PostController::class,'vehicule_commande'])->name('vehicule_commande');
Route::get('/search',[PostController::class,'search'])->name('search');
Route::post('/validation-formulaire-panier-reservation/{id}',[PostController::class,'valide_reservation'])->name('valide_reservation');
Route::get('/panier-validation',[PostController::class,'panier'])->name('panier');
Route::get('/formulaire-panier/{id}/{date1}/{date2}', [PostController::class,'formulaire_panier'])->name('formulaire_panier');
Route::post('/traitement-formulaire/{id}/{date1}/{date2}', [PostController::class,'traitement_formulaire'])->name('traitement_formulaire');
Auth::routes();
Route::get('/accueil',[HomeController::class,'index']);
Route::get('/deconnexion',[HomeController::class,'deconnexion'])->name('deconnexion');
/**Pour les route admin */
route::group(["middleware" => ["admin"]], function(){
    Route::get('/tableau',[AdminController::class,'dashbord'])->name('dashbord');
      //########################################################################################
    //pour la partie Users
    Route::get('/users',[AdminController::class,'user'])->name('user');
    Route::get('/membres',[AdminController::class,'membre'])->name('membre');
    Route::post('/ajouter-membre',[AdminController::class,'ajouter_membre'])->name('ajouter_membre');
    Route::post('/modification-membre',[AdminController::class,'modification_membre'])->name('modification_membre');
    Route::get('/suppresion-membre/{id}',[AdminController::class,'suppresion_membre'])->name('suppresion_membre')->where('id', '[0-9]+');;
    Route::get('/suppresion-user/{id}',[AdminController::class,'suppresion_user'])->name('suppresion_user')->where('id', '[0-9]+');;
    Route::get('/modification-membre/{id}',[AdminController::class,'modifier_membre'])->name('modifier_membre')->where('id', '[0-9]+');;
    Route::post('/update-membre',[AdminController::class,'update_membre'])->name('update_membre');
      //########################################################################################
    //pour la partie agences
    Route::get('/agences',[AdminController::class,'agences'])->name('agences');
    Route::get('/ajout-agences',[AdminController::class,'ajout_agence'])->name('ajout_agence');
    Route::get('/modification-agences/{id}',[AdminController::class,'modification_agence'])->name('modification_agence')->where('id', '[0-9]+');;
    Route::post('/save-agences',[AdminController::class,'save_agence'])->name('save_agence');
    Route::post('/save-agences/{id}',[AdminController::class,'update_agence'])->name('update_agence');
    Route::get('/suppression-agence/{id}',[AdminController::class,'delete_agence'])->name('delete_agence')->where('id', '[0-9]+');;
     //########################################################################################
    //partie des commissions
    Route::get('/commission',[AdminController::class,'commissions'])->name('commissions');
    Route::get('/ajout-commission',[AdminController::class,'ajouter_commission'])->name('ajouter_commission');
    Route::post('Enregistrer-commissison',[AdminController::class,'save_commission'])->name('save_commission');
    Route::get('/supprimer-commisssion/{id}',[AdminController::class,'delete_commission'])->name('delete_commission')->where('id', '[0-9]+');
    Route::get('/modifier-commisssion/{id}',[AdminController::class,'update_commission'])->name('update_commission')->where('id', '[0-9]+');
    Route::post('modification-commission/{id}',[AdminController::class,'updave_commiss'])->name('updave_commiss')->where('id', '[0-9]+');
    //########################################################################################
    //pour la partie des voitures
    Route::get('/vehicules',[AdminController::class,'vehicule'])->name('vehicule');
    Route::get('/ajouter-vehicules',[AdminController::class,'ajout_vehicule'])->name('ajout_vehicule');
    Route::post('/save-vehicules',[AdminController::class,'save_vehicule'])->name('save_vehicule');
    Route::get('/delete-vehicules/{id}',[AdminController::class,'delete_vehicule'])->name('delete_vehicule')->where('id', '[0-9]+');
    Route::get('/dossier-vehicule/{id}',[AdminController::class,'voir_vehicule'])->name('voir_vehicule')->where('id', '[0-9]+');
    //##########################################
    //partie vehicule partenaire 
    Route::get('/vehicules-partenaires',[AdminController::class,'vehicule_partenaire'])->name('vehicule_partenaire');
    Route::get('/ajout-vehicule-partenaire',[AdminController::class,'ajout_vehicule_partenaire'])->name('ajout_vehicule_partenaire');
    Route::post('/enregistrer-vehicule-partenaire',[AdminController::class,'save_vehicule_partenaire'])->name('save_vehicule_partenaire');
    Route::get('/delete-vehicule-partenaires/{id}',[AdminController::class,'delete_vh_pt'])->name('delete_vh_pt')->where('id', '[0-9]+');
    //###################################################
    //liste des tafis
    Route::get('/taris',[AdminController::class,'tarif'])->name('tarif');
    Route::get('/ajout-taris',[AdminController::class,'ajout_tarif'])->name('ajout_tarif');
    Route::post('/save-taris',[AdminController::class,'save_tarif'])->name('save_tarif');
    Route::get('/delete-taris/{id}',[AdminController::class,'delete_tarif'])->name('delete_tarif')->where('id', '[0-9]+');
    Route::get('/update-taris/{id}',[AdminController::class,'update_tarif'])->name('update_tarif')->where('id', '[0-9]+');
    Route::post('/update-taris-save/{id}',[AdminController::class,'save_update_tarif'])->name('save_update_tarif')->where('id', '[0-9]+');
    ###################################################################
    //partie promotion
    Route::get('/promotion',[AdminController::class,'promotion'])->name('promotion');
    Route::get('/ajouter-promotion',[AdminController::class,'ajout_promotion'])->name('ajout_promotion');
    Route::post('/save-promotion',[AdminController::class,'save_promotion'])->name('save_promotion');
    Route::get('/delete-promotion/{id}',[AdminController::class,'delete_promo'])->name('delete_promo')->where('id', '[0-9]+');
    Route::get('/update-promotion/{id}',[AdminController::class,'update_promo'])->name('update_promo')->where('id', '[0-9]+');
    Route::post('/save-update-promo/{id}',[AdminController::class,'save_update_promotion'])->name('save_update_promotion');
    Route::get('/publication-site/{id}',[AdminController::class,'yespub_promo'])->name('yespub_promo')->where('id', '[0-9]+');
    Route::get('/republication-site/{id}',[AdminController::class,'nonpub_promo'])->name('nonpub_promo')->where('id', '[0-9]+');
    ################################################################################
    //pour la partie des conducteur
    Route::get('/conducteurs',[AdminController::class,'conducteur'])->name('conducteur');
    Route::get('/ajout-conducteurs',[AdminController::class,'ajout_conducteur'])->name('ajout_conducteur');
    Route::post('/save-conducteur',[AdminController::class,'save_conducteur'])->name('save_conducteur');
    Route::get('/delete-conducteur/{id}',[AdminController::class,'delete_conducteur'])->name('delete_conducteur')->where('id', '[0-9]+');
    Route::get('/update-conducteur/{id}',[AdminController::class,'update_conducteur'])->name('update_conducteur')->where('id', '[0-9]+');
    Route::post('/save-update-conducteur/{id}',[AdminController::class,'save_update_conducteur'])->name('save_update_conducteur')->where('id', '[0-9]+');
    ##################################################################################
    //pour la partie des client
    Route::get('/clients',[AdminController::class,'client'])->name('client');
    Route::get('/ajout-clients',[AdminController::class,'ajouter_client'])->name('ajouter_client');
    Route::post('/save-clients',[AdminController::class,'save_client'])->name('save_client');
    Route::get('/delete-clients/{id}',[AdminController::class,'delete_client'])->name('delete_client')->where('id', '[0-9]+');
    ###################################################################################
    //pour la partie des commande
    Route::get('/commandes',[AdminController::class,'commande'])->name('commande');
    Route::get('/ajout-commandes',[AdminController::class,'ajouter_commande'])->name('ajouter_commande');
    Route::post('/save-commandes',[AdminController::class,'save_commmande'])->name('save_commmande');
    Route::get('/delete-commandes/{id}',[AdminController::class,'delete_commande'])->name('delete_commande')->where('id', '[0-9]+');
    Route::get('/dossier-commande/{id}',[AdminController::class,'voir_commande'])->name('voir_commande')->where('id', '[0-9]+');
    Route::get('/facture-commande/{id}',[AdminController::class,'facture_pdf'])->name('facture_pdf')->where('id', '[0-9]+');
    Route::get('/valide-commande/{id}',[AdminController::class,'valide_commande'])->name('valide_commande')->where('id', '[0-9]+');
    Route::post('/save-valide-commande/{id}',[AdminController::class,'save_valide_commande'])->name('save_valide_commande');
    Route::get('/commande-envoyer',[AdminController::class,'commande_envoyer'])->name('commande_envoyer');
    Route::get('/commande-valide-commission/{id}',[AdminController::class,'valid_commission'])->name('valid_commission');
    Route::get('/delete-commande-valide-commission/{id}',[AdminController::class,'delete_valid_commission'])->name('delete_valid_commission');
    #######################################################################################
    //pour la partie des devis
    Route::get('/devis',[AdminController::class,'devis'])->name('devis');
    //pour la partie des contrat
    Route::get('/annonces',[AdminController::class,'annonce'])->name('annonces');
    //pour la partie des contrat
    Route::get('/messages',[AdminController::class,'message'])->name('message');
    Route::get('/delete-messages/{id}',[AdminController::class,'delete_message'])->name('delete_message');
    Route::get('/valider-messages/{id}',[AdminController::class,'valider_message'])->name('valider_message');
});
//pour la partie membre meddeleware
route::group(["middleware" => ["membre"]], function(){
    Route::get('/users',[MembreController::class,'user'])->name('user');
    Route::get('/agences',[MembreController::class,'agences'])->name('agences');
    Route::get('/ajout-agences',[MembreController::class,'ajout_agence'])->name('ajout_agence');
    Route::post('/save-agences',[MembreController::class,'save_agence'])->name('save_agence');
    Route::get('/vehicules',[MembreController::class,'vehicule'])->name('vehicule');
    Route::get('/ajouter-vehicules',[MembreController::class,'ajout_vehicule'])->name('ajout_vehicule');
    Route::post('/save-vehicules',[MembreController::class,'save_vehicule'])->name('save_vehicule');
    Route::get('/dossier-vehicule/{id}',[MembreController::class,'voir_vehicule'])->name('voir_vehicule');
    Route::get('/vehicules-partenaires',[MembreController::class,'vehicule_partenaire'])->name('vehicule_partenaire');
    Route::get('/ajout-vehicule-partenaire',[MembreController::class,'ajout_vehicule_partenaire'])->name('ajout_vehicule_partenaire');
    Route::post('/enregistrer-vehicule-partenaire',[MembreController::class,'save_vehicule_partenaire'])->name('save_vehicule_partenaire');
    Route::get('/taris',[MembreController::class,'tarif'])->name('tarif');
    Route::get('/ajout-taris',[MembreController::class,'ajout_tarif'])->name('ajout_tarif');
    Route::post('/save-taris',[MembreController::class,'save_tarif'])->name('save_tarif');
    Route::get('/promotion',[MembreController::class,'promotion'])->name('promotion');
    Route::get('/ajouter-promotion',[MembreController::class,'ajout_promotion'])->name('ajout_promotion');
    Route::post('/save-promotion',[MembreController::class,'save_promotion'])->name('save_promotion');
    Route::get('/conducteurs',[MembreController::class,'conducteur'])->name('conducteur');
    Route::get('/ajout-conducteurs',[MembreController::class,'ajout_conducteur'])->name('ajout_conducteur');
    Route::post('/save-conducteur',[MembreController::class,'save_conducteur'])->name('save_conducteur');
    Route::get('/clients',[MembreController::class,'client'])->name('client');
    Route::get('/ajout-clients',[MembreController::class,'ajouter_client'])->name('ajouter_client');
    Route::post('/save-clients',[MembreController::class,'save_client'])->name('save_client');
    //pour la partie des commande
    Route::get('/commandes',[MembreController::class,'commande'])->name('commande');
    Route::get('/ajout-commandes',[MembreController::class,'ajouter_commande'])->name('ajouter_commande');
    Route::post('/save-commandes',[MembreController::class,'save_commmande'])->name('save_commmande');
    Route::get('/dossier-commande/{id}',[MembreController::class,'voir_commande'])->name('voir_commande')->where('id', '[0-9]+');
    Route::get('/valide-commande/{id}',[MembreController::class,'valide_commande'])->name('valide_commande')->where('id', '[0-9]+');
    Route::post('/save-valide-commande/{id}',[MembreController::class,'save_valide_commande'])->name('save_valide_commande');
    Route::get('/messages',[MembreController::class,'message'])->name('message');
    Route::get('/valider-messages/{id}',[MembreController::class,'valider_message'])->name('valider_message');
    Route::get('/facture-commande/{id}',[MembreController::class,'facture_pdf'])->name('facture_pdf')->where('id', '[0-9]+');
    Route::get('/tableau',[MembreController::class,'dashbord'])->name('dashbord');
});