<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siege extends Model
{
    protected $fillable = ['bus_id', 'numero', 'disponible'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function reservations()
    {
        return $this->hasMany(\App\Models\Reservation::class);
    }
}