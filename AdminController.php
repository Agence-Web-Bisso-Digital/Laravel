<?php

namespace App\Http\Controllers;
use PDF;
use DateTime;
use App\Models\User;
use App\Models\tarfi;
use App\Models\client;
use App\Models\commande;
use App\Models\commande_valide;
use App\Models\vehicule;
use App\Models\promotion;
use App\Models\commission;
use App\Models\conducteur;
use App\Models\contact;
use App\Models\partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\vehicule_partenaire;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function dashbord(){
        $voiture = DB::table('vehicules')->count();
        $commande = DB::table('commandes')->count();
        $user = DB::table('users')->count();
        $contact = DB::table('contacts')->count();
        $grap=commande::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))->pluck('count');
        return view('../dashboard/menu',compact('voiture','commande','user','contact','grap'));
    }
    //partie user
    //########################################################################################
    public function user(){
        $user=User::select('*')->where('role','=','user')->orderBy('created_at', 'desc')->get();
        return view('../dashboard/user',compact('user'));
    }
    public function membre(){
        $user=User::select('*')->where('role','!=','user')->orderBy('created_at', 'desc')->get();
        return view('../dashboard/membre',compact('user'));
    }
    public function ajouter_membre(Request $request){
        $validated = $request->validate([
            'nom' => 'required|max:25',
            'email' => 'required|unique:users,email',
            'role' => 'required|max:25',
            'mdp' => 'required|min:4|max:12',
        ]);
        $user=new User();
        $user->name=$request->nom;
        $user->email=$request->email;
        $user->password=Hash::make($request->mdp);
        $user->role=$request->role;
        $user->save();
        return redirect()->route('membre')->with('status','Félicitation, le membre à bien été enregistré avec succès');
    }
    public function suppresion_membre($id){
       DB::table('users')->where('id',$id)->delete();
       return redirect()->route('membre')->with('status','Félicitation, le membre à bien été supprimé avec succès');
    }
    public function suppresion_user($id){
       DB::table('users')->where('id',$id)->delete();
       return redirect()->route('user')->with('status','Félicitation, le membre à bien été supprimé avec succès');
    }
    public function modifier_membre($id){
        $user=User::find($id);
        return view('../dashboard/modifier_membre',compact('user'));
    }
    public function update_membre(Request $request){
        $id=$request->id;
        $nom=$request->nom;
        $email=$request->email;
        $mdp=Hash::make($request->mdp);
        $role=$request->role;
        DB::table('users')->where('id',$id)->update(
            ['name'=>$nom,
            'email'=>$email,
            'password'=>$mdp,
            'role'=>$role]);
            return redirect()->route('membre')->with('status','Félicitation, le membre à bien été modifié avec succès');
        }
        //fin user
        //########################################################################################
        //pour la partie agence
        public function agences(){
            $agence=partenaire::all();
            return view('../dashboard/agence',compact('agence'));
        }
        public function delete_agence($id){
            $agence=partenaire::find($id);
            $photo=$agence->url_image;
            File::delete($photo);
            DB::table('partenaires')->where('id',$id)->delete();
            return redirect()->route('agences')->with('status','Félicitation, l\'agence à bien été supprimée avec succès');
        }
        public function ajout_agence(){
            return view('../dashboard/ajout_agence');
        }
        public function modification_agence($id){
            $agence=partenaire::find($id);
            return view('../dashboard/modification_agence',compact('agence'));
        }
        public function save_agence(Request $request){
            if($request->site==""){
                $validated = $request->validate([
                    'nom' => 'required|max:255',
                    'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'email'=>'required|unique:partenaires,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'ville'=>'required',
                    'adresse'=>'required',
                    'voiture'=>'required',
                    'photo'=>'required|mimes:jpeg,png,jpg|max:20000'
                ]);
                $fichier=Storage::disk('public')->put('image_agence',$request->photo);
                $partenaire=new partenaire();
                $partenaire->nom_agence=$request->nom;
                $partenaire->telephone=$request->telephone;
                $partenaire->email=$request->email;
                $partenaire->ville=$request->ville;
                $partenaire->adresse=$request->adresse;
                $partenaire->site="http://www.default.ma";
                $partenaire->nombre_v=$request->voiture;
                $partenaire->url_image="storage/".$fichier;
                $partenaire->save();
                return redirect()->route('ajout_agence')->with('status','Félicitation, l\' agence à bien été enregistrée et publiée sur le site de solace car avec succès');
            }
            else{
                $validated = $request->validate([
                    'nom' => 'required|max:255',
                    'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'email'=>'required|unique:partenaires,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'ville'=>'required',
                    'adresse'=>'required',
                    'site'=>'required',
                    'voiture'=>'required',
                    'photo'=>'required|mimes:jpeg,png,jpg|max:20000'
                ]);
                $fichier=Storage::disk('public')->put('image_agence',$request->photo);
                $partenaire=new partenaire();
                $partenaire->nom_agence=$request->nom;
                $partenaire->telephone=$request->telephone;
                $partenaire->email=$request->email;
                $partenaire->ville=$request->ville;
                $partenaire->adresse=$request->adresse;
                $partenaire->site=$request->site;
                $partenaire->nombre_v=$request->voiture;
                $partenaire->url_image="storage/".$fichier;
                $partenaire->save();
                return redirect()->route('ajout_agence')->with('status','Félicitation, l\' agence à bien été enregistrée et publiée sur le site de solace car avec succès');
            }
        }
        public function update_agence($id, Request $request){
            if($request->photo==""){
                $partenaire=new partenaire();
                $partenaire->nom_agence=$request->nom;
                $partenaire->telephone=$request->telephone;
                $partenaire->email=$request->email;
                $partenaire->ville=$request->ville;
                $partenaire->adresse=$request->adresse;
                $partenaire->site=$request->site;
                $partenaire->nombre_v=$request->voiture;
               DB::table('partenaires')->where('id',$id)->update([
                'nom_agence'=>$request->nom,
                'telephone'=>$request->telephone,
                'email'=>$request->email,
                'adresse'=>$request->adresse,
                'site'=>$request->site,
                'nombre_v'=>$request->voiture
               ]);
               return redirect()->route('agences')->with('status','Félicitation, l\' agence à bien été modifiée et publiée sur le site de solace car avec succès');
            }
            else{
                $fichier=Storage::disk('public')->put('image_agence',$request->photo);
                $partenaire=partenaire::find($id);
                file::delete($partenaire->url_image);
                $partenaire->nom_agence=$request->nom;
                $partenaire->telephone=$request->telephone;
                $partenaire->email=$request->email;
                $partenaire->ville=$request->ville;
                $partenaire->adresse=$request->adresse;
                $partenaire->site=$request->site;
                $partenaire->nombre_v=$request->voiture;
               DB::table('partenaires')->where('id',$id)->update([
                'nom_agence'=>$request->nom,
                'telephone'=>$request->telephone,
                'email'=>$request->email,
                'adresse'=>$request->adresse,
                'site'=>$request->site,
                'nombre_v'=>$request->voiture,
                'url_image'=>"storage/".$fichier
               ]);
               return redirect()->route('agences')->with('status','Félicitation, l\' agence à bien été modifiée et publiée sur le site de solace car avec succès');
            }
        }
        //fin agence
        //########################################################################################
        //partie pour les commissions
        public function commissions(){
            $commiss=commission::all();
            return view('../dashboard/commision',compact('commiss'));
        }
        public function ajouter_commission(){
            $agence=partenaire::all();
            return view('../dashboard/ajout_commission',compact('agence'));
        }
        public function save_commission(Request $request){
            $validated=$request->validate([
                'montant'=>'required|numeric',
                'pourcentage'=>'required|numeric'
            ]);
            $comiss=new commission();
            $pour=$request->pourcentage.'%';
            $comiss->montant=$request->montant;
            $comiss->pourcentage=$pour;
            $comiss->id_partenaire=$request->agence;
            $comiss->save();
            return redirect()->route('ajouter_commission')->with('status','Félicitation, cette commission à bien été enregistrée');
        }
        public function delete_commission($id){
            DB::table('commissions')->where('id',$id)->delete();
            return redirect()->route('commissions')->with('status','Félicitation, cette commission à bien été supprimée');
        }
        public function update_commission($id){
            $agence=commission::find($id);
            return view('../dashboard/update_commission',compact('agence'));
        }
        public function updave_commiss(Request $request ,$id){
            $validated=$request->validate([
                'montant'=>'required|numeric',
                'pourcentage'=>'required'
            ]);
            DB::table('commissions')->where('id',$id)->update([
                'montant'=>$request->montant,
                'pourcentage'=>$request->pourcentage
            ]);
            return redirect()->route('commissions')->with('status','Félicitation, cette commission à bien été modifiée avec succès');
        }
        //fin commision
        //########################################################################################
        //pour la partie vehicule
        public function vehicule(){
            $voiture=vehicule::all();
            return view('../dashboard/vehicule',compact('voiture'));
        }
        public function ajout_vehicule(){
            return view('../dashboard/ajout_vehicule');
        }
        public function save_vehicule(Request $request){
            $validated=$request->validate([
                'nom'=>'Required',
                'modele'=>'Required',
                'carburant'=>'Required',
                'boite'=>'Required',
                'place'=>'Required|numeric',
                'kilometre'=>'Required',
                'date'=>'Required',
                'photo'=>'required|mimes:jpeg,png,jpg|max:20000'
            ]);
            $fichier=Storage::disk('public')->put('image_voiture',$request->photo);
            $voiture=new vehicule();
            $voiture->nom=$request->nom;
            $voiture->marque=$request->modele;
            $voiture->carburation=$request->carburant;
            $voiture->boite_vitesse=$request->boite;
            $voiture->place=$request->place;
            $voiture->kilometrage=$request->kilometre;
            $voiture->annee_creation=$request->date;
            $voiture->image_card='storage/'.$fichier;
            $voiture->save();
            return redirect()->route('ajout_vehicule')->with('status','Félicitation,le véhicule à bien été ajouté avec succès');
        }
        public function delete_vehicule($id){
            $voiture=vehicule::find($id);
            $photo=$voiture->image_card;
            File::delete($photo);
            DB::table('vehicules')->where('id',$id)->delete();
            return redirect()->route('vehicule')->with('status','Félicitation, cette voiture à bien été supprimée avec succès');
        }
        public function voir_vehicule($id){
            $voiture=vehicule::find($id);
            return view('../dashboard/voir_vehicule',compact('voiture'));
        }
        //fin
        //###########################################
        //partie véhicule partenaire
        public function vehicule_partenaire(){
            $vehicule=vehicule_partenaire::all();
            return view('../dashboard/vehicule_partenaire',compact('vehicule'));
        }
        public function ajout_vehicule_partenaire(){
            $agence=partenaire::all();
            $voiture=vehicule::all();
            return view('../dashboard/ajout_vehicule_partenaire',compact('agence','voiture'));
        }
        public function save_vehicule_partenaire(Request $request){
            $validated=$request->validate([
                'agence*'=>'required',
                'voiture*'=>'required'
            ]);
            $ag=$request->agence;
            $vt=$request->voiture;
            $agence=implode(",",$ag);
            $voiture=implode(",",$vt);
            $vh_pt=new vehicule_partenaire();
            $vh_pt->id_partenaire=$agence;
            $vh_pt->id_vehicule=$voiture;
            $vh_pt->save();
            return redirect()->route('ajout_vehicule_partenaire')->with('status','Félicitation, les véhicules pour vos partenaires ont été bien ajoutés');
        }
        public function delete_vh_pt($id){
            DB::table('vehicule_partenaires')->where('id',$id)->delete();
            return redirect()->route('vehicule_partenaire')->with('status','Félicitation, ces informations pour le véhicule partenaire on été bien supprimées');
        }
        ######################################
        //liste de starifs
        public function tarif(){
            $tarif=tarfi::all();
            return view('../dashboard/tarif',compact('tarif'));
        }
        public function ajout_tarif(){
            $voiture=vehicule::all();
            return view('../dashboard/ajout_tarif',compact('voiture'));
        }
        public function save_tarif(Request $request){
            $validated=$request->validate([
                "prix"=>'required|numeric',
                "voiture"=>'required|unique:tarfis,id_vehicule'
            ]);
            $tarif=new tarfi();
            $tarif->prix=$request->prix;
            $tarif->id_vehicule=$request->voiture;
            $tarif->save();
            return redirect()->route('ajout_tarif')->with('status','Félicitation, ce tarif à bien été enregistré avec succès');
        }
        public function delete_tarif($id){
            DB::table('tarfis')->where('id',$id)->delete();
            return redirect()->route('tarif')->with('status','Félicitation, le tarif pour le véhicule à bien été supprimé avec succès');
        }
        public function update_tarif($id){
            $tarif=tarfi::find($id);
            return view('../dashboard/update_tarif',compact('tarif'));
        }
        public function save_update_tarif(Request $request,$id){
            $prix=$request->prix;
            DB::table('tarfis')->where('id',$id)->update([
                'prix'=>$prix
            ]);
            return redirect()->route('tarif')->with('status','Félicitation, le tarif à bien été modifié avec succès');
        }
        ###########################################################################
        //partie promotion 
        public function promotion(){
            $promo=promotion::all();
            return view('../dashboard/promotion',compact('promo'));
        }
        public function ajout_promotion(){
            $voiture=vehicule::all();
            return view('../dashboard/ajout_promotion',compact('voiture'));
        }
        public function save_promotion(Request $request){
            $validated=$request->validate([
                "prix1"=>'required|numeric',
                "prix2"=>'required|numeric',
                "voiture"=>'required|unique:promotions,vehicule_id'
            ]);
            $promo=new promotion();
            $promo->montant_j=$request->prix1;
            $promo->montant_jx=$request->prix2;
            $promo->date_debut=$request->date1;
            $promo->date_fin=$request->date2;
            $promo->vehicule_id=$request->voiture;
            $promo->save();
            return redirect()->route('ajout_promotion')->with('status','Félicitation,cette promotion à bien été enregistrée avec succès');
        }
        public function delete_promo($id){
            DB::table('promotions')->where('id',$id)->delete();
            return redirect()->route('promotion')->with('status','Félicitation,cette promotion à bien été supprimée avec succès');
        }
        public function update_promo($id){
            $promo=promotion::find($id);
            return view('../dashboard/update_promo',compact('promo'));
        }
        public function save_update_promotion(Request $request,$id){
            $prix1=$request->prix1;
            $prix2=$request->prix2;
            $date1=$request->date1;
            $date2=$request->date2;
            DB::table('promotions')->where('id',$id)->update([
                'montant_j'=>$prix1,
                'montant_jx'=>$prix2,
                'date_debut'=>$date1,
                'date_fin'=>$date2
            ]);
            return redirect()->route('promotion')->with('status','Félicitation, la promotion à bien été modifiée avec succès');
        }
        public function yespub_promo($id){
            DB::table('promotions')->where('id',$id)->update([
                'status'=>'Publié'
            ]);
            return redirect()->route('promotion')->with('status','Félicitation, cette publication vient d\' être publiée sur le site de solace car');
        }
        public function nonpub_promo($id){
            DB::table('promotions')->where('id',$id)->update([
                'status'=>'Non publié'
            ]);
            return redirect()->route('promotion')->with('status','Félicitation, cette publication vient d\' être retirée sur le site de solace car');
        }
        ############################################################################
        //pour la partie conducteur
        public function conducteur(){
            $conduct=conducteur::all();
            return view('../dashboard/conducteur',compact('conduct'));
        }
        public function ajout_conducteur(){
            return view('../dashboard/ajout_conducteur');
        }
        public function save_conducteur(Request $request){
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'prenom' => 'required|max:255',
                'permis' => 'required|max:255',
                'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email'=>'required|unique:conducteurs,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'adresse'=>'required',
            ]);
            $conduct=new conducteur();
            $conduct->nom=$request->nom;
            $conduct->prenom=$request->prenom;
            $conduct->permis=$request->permis;
            $conduct->telephone=$request->telephone;
            $conduct->email=$request->email;
            $conduct->adresse=$request->adresse;
            $conduct->save();
            return redirect()->route('ajout_conducteur')->with('status','Félicitation, le conducteur à bien été ajouté avec  succès');
        }
        public function delete_conducteur($id){
            DB::table('conducteurs')->where('id',$id)->delete();
            return redirect()->route('conducteur')->with('status','Félicitation, le conducteur à bien été supprimé avec  succès');
        }
        public function update_conducteur($id){
            $conduct=conducteur::find($id);
            return view('../dashboard/update_conducteur',compact('conduct'));
        }
        public function save_update_conducteur(Request $request,$id){
            $nom=$request->nom;
            $prenom=$request->prenom;
            $permis=$request->permis;
            $tel=$request->telephone;
            $email=$request->email;
            $adress=$request->adresse;
            DB::table('conducteurs')->where('id',$id)->update([
                'nom'=>$nom,
                'prenom'=>$prenom,
                'permis'=>$permis,
                'telephone'=>$tel,
                'email'=>$email,
                'adresse'=>$adress
            ]);
            return redirect()->route('conducteur')->with('status','Félicitation, le conducteur à bien été modifié avec  succès');
        }
        #########################################
        //pour la partie client
        public function client(){
            $client=client::all();
            return view('../dashboard/client',compact('client'));
        }
        public function ajouter_client(){
            return view('../dashboard/ajouter_client');
        }
        public function save_client(Request $request){
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'prenom' => 'required|max:255',
                'date'=>'required',
                'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email'=>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'ville'=>'required',
                'adresse'=>'required',
            ]);
            $client=new client();
            $client->nom=$request->nom;
            $client->prenom=$request->prenom;
            $client->date_naissance=$request->date;
            $client->ville=$request->ville;
            $client->adresse=$request->adresse;
            $client->telephone=$request->telephone;
            $client->email=$request->email;
            $client->save();
            return redirect()->route('ajouter_client')->with('status','Félicitation le client à bien été enregistré avec succès');
        }
        public function delete_client($id){
            DB::table('clients')->where('id',$id)->delete();
            return redirect()->route('client')->with('status','Félicitation le client à bien été supprimé avec succès');
        }
        ##############################################################
        //pour la partie commande
        public function commande(){
            $commande=commande::all();
            //$voiture=vehicule::where('id',$commande->vehicule_id)->first();
            //$commande->setAttribute('voiture',$voiture);
            return view('../dashboard/commande',compact('commande'));
        }
        public function ajouter_commande(){
            $client=client::all();
            $tarif=tarfi::all();
            return view('../dashboard/ajouter_commande',compact('client','tarif'));
        }
        public function save_commmande(Request $request){
            $validated=$request->validate([
                'client'=>'required',
                'date1'=>'required',
                'date2'=>'required',
                'voiture'=>'required',
                'note'=>'required'
            ]);
            $nv=$request->voiture;
            $tarif = tarfi::find($nv);
            $vh=$tarif->id;
            $tr_prix=$tarif->prix;
            $commande=new commande();
            $date1 = new DateTime($request->date1);
            $date2 = new DateTime($request->date2);
            $diff = $date2->diff($date1)->format("%a");
            $prix=$tr_prix*$diff;
            $commande->client_id=$request->client;
            $commande->date_livraison=$request->date1;
            $commande->date_remise=$request->date1;
            $commande->quantite=$diff;
            $commande->vehicule_id=$vh;
            $commande->total=$prix;
            $commande->note=$request->note;
            $commande->save();
            return redirect()->route('ajouter_commande')->with('status','Félicitation, la commande pour le client à bien été enregistrée avec succès');
        }
        public function delete_commande($id){
            DB::table('commandes')->where('id',$id)->delete();
            return redirect()->route('commande')->with('status','Félicitation, la commande pour le client à bien été supprimée avec succès');
        }
        public function voir_commande($id){
            $commande=commande::find($id);
            return view('../dashboard/voir_commande',compact('commande'));
        }
        public function facture_pdf($id){
            $commande=commande::find($id);
            $prix=$commande->total;
            $qt=$commande->quantite;
            $montant=$prix/$qt;
            $data = [
                'id'=>$commande->id,
                'dco'=>$commande->created_at,
                'nom' => $commande->client->nom,
                'prenom' =>$commande->client->prenom,
                'date'=> $commande->client->date_naissance,
                'telephone'=> $commande->client->telephone,
                'email'=> $commande->client->email,
                'ville'=>$commande->client->ville,
                'adresse'=>$commande->client->adresse,
                'date_livraison'=>$commande->date_livraison,
                'date_remise' =>$commande->date_remise,
                'quantite' => $commande->quantite, 
                'statut' => $commande->statut,
                'nomv' =>$commande->tarif->voiture->nom,
                'marquev'=> $commande->tarif->voiture->marque,
                'carburationv'=>$commande->tarif->voiture->carburation,
                'kilometragev'=> $commande->tarif->voiture->kilometrage,
                'boite_vitessev'=>$commande->tarif->voiture->boite_vitesse,
                'prix'=>$montant,
                'total'=>$commande->total
            ]; 
            $pdf = PDF::loadView('../dashboard/facture_pdf', $data);
            //$pdf->set_base_path('localhost/exampls/pdf.css');
            return $pdf->stream(); 
        }
        public function valide_commande($id){
            $agence=partenaire::all();
            return view('../dashboard/valide_commande',compact('agence','id'));
        }
        public function save_valide_commande(Request $request,$id){
            $valide=new commande_valide();
            $valide->id_commande=$id;
            $valide->id_agence=$request->agence;
            $valide->commission=$request->prix;
            $valide->save();
            DB::table('commandes')->where("id",$id)->update([
                'statut'=>'Valider'
            ]);
            return redirect()->route('commande')->with('status','Félicitation, la commande à bien été envoyée chez l\' une des agences partenaires');
        }
        public function commande_envoyer(){
            $com_valid=commande_valide::all();
            return view('../dashboard/commande_envoyer',compact('com_valid'));
        }
        public function valid_commission($id){
            DB::table('commande_valides')->where('id',$id)->update([
                'statut'=>'Payer'
            ]);
            return redirect()->route('commande_envoyer')->with('status','Félicitation, votre commission à bien été payée');
        }
        public function delete_valid_commission($id){
            DB::table('commande_valides')->where('id',$id)->delete();
            return redirect()->route('commande_envoyer')->with('status','Félicitation, votre commission à bien été supprimée avec succès');
        }
        
        #########################################################################
        //pour la partie message
        public function message(){
            $contact=contact::all();
            return view('../dashboard/message',compact('contact'));
        }
        public function delete_message($id){
            DB::table('contacts')->where('id',$id)->delete();
            return redirect()->route('message')->with('status','Félicitation,ce message à bien été supprimé avec succès');
        }
        public function valider_message($id){
            DB::table('contacts')->where('id',$id)->update([
                'statut'=>'Traiter'
            ]);
            return redirect()->route('message')->with('status','Félicitation,ce message à bien traité avec succès');
        }
       ###############################################################################"
       //dashbord
       


        }
        
