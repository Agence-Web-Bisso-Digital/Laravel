<?php

namespace App\Models;

use App\Models\tarfi;
use App\Models\client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class commande extends Model
{
    use HasFactory;
   /*
     public function voiture()
    {
        return $this->belongsTo(vehicule::class, 'vehicule_id');
    }
   */
    public function tarif()
    {
        return $this->belongsTo(tarfi::class, 'vehicule_id');
    }
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id');
    }
}
