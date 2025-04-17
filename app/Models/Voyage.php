<?php

// app/Models/Voyage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voyage extends Model
{
    protected $fillable = ['trajet_id', 'bus_id', 'date_depart', 'heure_depart'];

    public function trajet(): BelongsTo
    {
        return $this->belongsTo(Trajet::class);
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }
}