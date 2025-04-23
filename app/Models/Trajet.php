<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trajet extends Model
{
    // app/Models/Trajet.php
    // app/Models/Trajet.php
    protected $fillable = [
        'ville_depart',
        'ville_arrivee',
        'standing',
        'prix',
        'agence_id' ,
        'statut'
    ];

    const STATUT_ACTIF = 'Actif';
    const STATUT_INACTIF = 'Inactif';

    // Scope pour les éléments actifs
    public function scopeActif($query){
        return $query->where('statut', self::STATUT_ACTIF);
    }

    // "Suppression" (désactivation)
    public function desactiver(){
        $this->update(['statut' => self::STATUT_INACTIF]);
    }

    public function agence(){
        return $this->belongsTo(Agence::class);
    }

// Garder la relation voyages si nécessaire
    public function voyages(){
        return $this->hasMany(Voyage::class)->actif();
    }
}
