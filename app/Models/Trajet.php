<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'ville_depart',
        'ville_arrivee',
        'standing',
        'prix',
        'agence_id',
        'statut'
    ];

    const STATUT_ACTIF = 'Actif';
    const STATUT_INACTIF = 'Inactif';

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function desactiver()
    {
        $this->update(['statut' => self::STATUT_INACTIF]);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class)->actif();
    }
}