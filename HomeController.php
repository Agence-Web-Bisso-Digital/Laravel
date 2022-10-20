<?php

namespace App\Http\Controllers;

use App\Models\commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {     $voiture = DB::table('vehicules')->count();
        $commande = DB::table('commandes')->count();
        $user = DB::table('users')->count();
        $contact = DB::table('contacts')->count();
        $grap=commande::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))->pluck('count');
        
         
        if( Auth::user()->role=="user"){
            $vt = DB::table('vehicules')->select('marque')->distinct()->get();
            $selection = DB::table('vehicules')->limit(3)->get();
            return view('../components/accueil',compact('vt','selection'));
        }
        else{
            return view('../dashboard/menu',compact('voiture','commande','user','contact','grap'));
        }
        
    }
    public function deconnexion(Request $request){
        Auth::logout();
        return Redirect()->route('login');
    }
}
