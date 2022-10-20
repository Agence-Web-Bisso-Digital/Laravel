<?php

namespace App\Http\Controllers;
use PDF;
use DateTime;
use App\Models\User;
use App\Models\tarfi;
use App\Models\client;
use App\Models\contact;
use App\Models\commande;
use App\Models\vehicule;
use App\Models\promotion;
use App\Models\conducteur;
use App\Models\partenaire;
use Illuminate\Http\Request;
use App\Models\commande_valide;
use Illuminate\Support\Facades\DB;
use App\Models\vehicule_partenaire;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MembreController extends Controller
{
    public function __construct()
    {
        $this->middleware('membre');
    }
    public function user(){
        $user=User::select('*')->where('role','=','user')->orderBy('created_at', 'desc')->get();
        return view('../dashboard/user',compact('user'));
    }
    //pour la partie agence
    public function agences(){
        $agence=partenaire::all();
        return view('../dashboard/agence',compact('agence'));
    }
    public function ajout_agence(){
        return view('../dashboard/ajout_agence');
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
    public function voir_vehicule($id){
        $voiture=vehicule::find($id);
        return view('../dashboard/voir_vehicule',compact('voiture'));
    }
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
        public function voir_commande($id){
            $commande=commande::find($id);
            return view('../dashboard/voir_commande',compact('commande'));
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
        public function message(){
            $contact=contact::all();
            return view('../dashboard/message',compact('contact'));
        }
        public function valider_message($id){
            DB::table('contacts')->where('id',$id)->update([
                'statut'=>'Traiter'
            ]);
            return redirect()->route('message')->with('status','Félicitation,ce message à bien traité avec succès');
        }
        public function index(){
            return view('../dashboard/menu');
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
          //dashbord
           public function dashbord(){
        $voiture = DB::table('vehicules')->count();
        $commande = DB::table('commandes')->count();
        $user = DB::table('users')->count();
        $contact = DB::table('contacts')->count();
        $grap=commande::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))->pluck('count');
        return view('../dashboard/menu',compact('voiture','commande','user','contact','grap'));
    }
}
