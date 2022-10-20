<?php

namespace App\Models;

use App\Models\vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class promotion extends Model
{
    use HasFactory;
    public function voiture()
    {
        return $this->belongsTo(vehicule::class, 'vehicule_id');
    }
}
