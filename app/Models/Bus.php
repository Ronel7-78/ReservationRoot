<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bus extends Model
{
    protected $fillable = [
        'agence_id',
        'libelle',
        'immatriculation',
        'type',
        'photo_interieur',
        'photo_exterieur',
        'nombre_place',
        'statut'
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function voyages()
    {
        //return $this->hasMany(Voyage::class);
    }

    protected static function boot(){
    parent::boot();

    static::deleting(function ($bus) {
        Storage::disk('public')->delete([
            $bus->photo_interieur,
            $bus->photo_exterieur
        ]);
    });
    }

    // Vérifie la disponibilité du bus
    public function estDisponible($date)
    {
        //return !$this->voyages()
        //    ->whereDate('date_depart', $date)
         //   ->exists();
    }
}
