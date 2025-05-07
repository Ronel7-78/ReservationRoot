<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code_agence',
        'nom_commercial',
        'logo',
        'localisation',
        'devise',
        'is_verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}