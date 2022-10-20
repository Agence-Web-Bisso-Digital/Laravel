<?php

namespace App\Models;

use App\Models\commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class commande_valide extends Model
{
    use HasFactory;
    public function commande()
    {
        return $this->belongsTo(commande::class, 'id_commande');
    }
    public function agence()
    {
        return $this->belongsTo(partenaire::class, 'id_agence');
    }
}
