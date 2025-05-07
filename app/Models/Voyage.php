<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voyage extends Model
{
    protected $fillable = ['trajet_id', 'bus_id', 'date_depart', 'statut'];

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

    public function trajet(): BelongsTo
    {
        return $this->belongsTo(Trajet::class);
    }

    public function reservations(){
    return $this->hasMany(Reservation::class);
    }

    public function bus(){
        return $this->belongsTo(Bus::class)->with(['agence', 'sieges']);
    }
}