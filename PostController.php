<?php

namespace App\Http\Controllers;

use App\Mail\ComandeMarkedownMail;
use App\Mail\ModelMarkedownMail;
use DateTime;
use App\Models\tarfi;
use App\Mail\TestMail;
use App\Models\client;
use App\Models\contact;
use App\Models\commande;
use App\Models\vehicule;
use App\Models\partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    
    //partie traitement formulaire
    public function traitement_formulaire(Request $request,$id,$date1,$date2){
        $tarif=tarfi::find($id);
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        $qt = $d2->diff($d1)->format("%a");
        $total=$tarif->prix*$qt;
        //dd($total);
        $nom=$request->nom;
        $prenom=$request->prenom;
        $date_n=$request->date;
        $adresse=$request->adresse;
        $ville=$request->ville;
        $telephone=$request->telephone;
        $email=$request->email;
        $message=$request->message;
        $client=new client();
        $client->nom=$nom;
        $client->prenom=$prenom;
        $client->date_naissance=$date_n;
        $client->ville=$ville;
        $client->adresse=$adresse;
        $client->telephone=$telephone;
        $client->email=$email;
        $client->save();
        if($message==""){
            $req_client = DB::table('clients')->where('email',$email)->first();
            $commande=new commande();
            $commande->client_id=$req_client->id;
            $commande->date_livraison=$date1;
            $commande->date_remise=$date2;
            $commande->quantite=$qt;
            $commande->vehicule_id=$id;
            $commande->total=$total;
            $commande->note="RAS";
            $commande->save();
            Mail::to($request->email)->send(new ComandeMarkedownMail());
            return redirect()->route('vehicules')->with('status','Félicitation, votre commande à bien été validée avec succès');
        }
        else{
            $req_client = DB::table('clients')->where('email',$email)->first();
            $commande=new commande();
            $commande->client_id=$req_client->id;
            $commande->date_livraison=$date1;
            $commande->date_remise=$date2;
            $commande->quantite=$qt;
            $commande->vehicule_id=$id;
            $commande->total=$total;
            $commande->note=$message;
            $commande->save();
            Mail::to($request->email)->send(new ComandeMarkedownMail());
            return redirect()->route('vehicules')->with('status','Félicitation, votre commande à bien été validée avec succès');
        }
        
        
        //dd($req_client);
    }
    //partie formulaire de validation
    public function formulaire_panier($id,$date1,$date2){

        return view('../components/formulaire',compact('id','date1','date2'));
    }
    //partie servation commande
   public function valide_reservation(Request $request, $id){
    $date1 = new DateTime($request->d1);
    $date2 = new DateTime($request->d2);
    //dd($date1);
    
    $qt = $date2->diff($date1)->format("%a");
    $tarif=tarfi::find($id);
    $date_en=$request->d1;
    $date_de=$request->d2;
    $montant=$qt*$tarif->prix;
    if($qt<=0){
        return redirect()->route('contact');
    }
    else{
        //return redirect('../components/panier', compact('voiture'));
       //return redirect()->route('panier')->with( ['voiture' => $voiture] );
       return view('../components/panier',compact('tarif','qt','date_en','date_de','montant'));
    }
    
   }
  
   public function contact(){
    $agence=partenaire::all();
       return view('../components/contact',compact('agence'));
   }
   public function devis_expres(Request $request){
        $date=$request->date;
        $tarif=tarfi::all();
        $marque = DB::table('vehicules')->select('marque')->distinct()->get();
        $prix = DB::table('tarfis')->select('prix')->distinct()->get();
        //$tarif1 = DB::table('tarfis')->select('item_name')->distinct()->get();
           return view('../components/vehicule',compact('tarif','marque','prix'));
       
   }
   public function condition(){
    $agence=partenaire::all();
    return view('../components/condition',compact('agence'));
    }
   public function agences1(){
    $agence=partenaire::all();
    return view('../components/service',compact('agence'));
    }
   public function vehicules(){
    $tarif=tarfi::all();
    $marque = DB::table('vehicules')->select('marque')->distinct()->get();
    $prix = DB::table('tarfis')->select('prix')->distinct()->get();
    //$tarif1 = DB::table('tarfis')->select('item_name')->distinct()->get();
       return view('../components/vehicule',compact('tarif','marque','prix'));
   }
   public function action_contact(Request $request){
        $validated=$request->validate([
            'prenom'=>'required|max:50|regex:/^[a-zA-ZÑñîôéèç\s]+$/',
            'nom'=>'required|max:50|regex:/^[a-zA-ZÑñîôéèç\s]+$/',
            'email'=>'required|max:50|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
            'telephone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message'=>'required|'
        ],
        [
            'nom.required'=>'Le nom est obligatoire',
            'prenom.required'=>'Le prénom est obligatoire',
            'email.required'=>'votre adresse élèctronique est obligatoire',
            'telephone.required'=>'Le téléphone portable est obligatoire',
            'message.required'=>'Le message est obligatoire',
        ]);
        $contact=new contact();
        $contact->nom=$request->nom;
        $contact->prenom=$request->prenom;
        $contact->telephone=$request->telephone;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->save();
        $client=['nom'=>$request->nom,'prenom'=>$request->prenom];
        Mail::to($request->email)->send(new ModelMarkedownMail($client));
        return redirect()->route('contact')->with('status','Félicitation, votre message à bien été envoyé avec succès.');
        //dd($contact);
   }
   /**
    * public function mail(){
    Mail::to('mokokoardeche@gmail.com')->send(new TestMail());
    return view('emails.contact');
    }
    */
   public function all_vehicule(){
    return view('all_vehicule');
   }
   public function vehicule_commande($id){
    $tarif=tarfi::find($id);
     return view('../components/vehicule_commande',compact('tarif'));
   }
   public function search(){
    $marque=$_GET['q'];
    //$voiture=vehicule::where('marque','LIKE','%'.$marque.'%')->get();
    $vehicule = DB::table('tarfis')
    ->join('vehicules', 'tarfis.id_vehicule', '=', 'vehicules.id')
    ->where('marque', $marque)
    ->get();
    return view('../components/vehicule_marque',compact('vehicule','marque'));
   }
}
