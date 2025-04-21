<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trajet extends Model
{
    // app/Models/Trajet.php
protected $fillable = [
    'ville_depart', 
    'ville_arrivee', 
    'standing', 
    'prix',
    'agence_id' // Ajouter ceci
];

    public function voyages(): HasMany
    {
        return $this->hasMany(Voyage::class);
    }
}
