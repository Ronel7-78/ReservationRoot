<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bus extends Model
{
    use HasFactory;
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

    public function siegesDisponibles()
    {
        return $this->hasMany(Siege::class)->where('disponible', true);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id'); // Spécifiez explicitement la clé étrangère
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class)->actif();
    }

    public function sieges()
    {
        return $this->hasMany(Siege::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($bus) {
            Storage::disk('public')->delete([
                $bus->photo_interieur,
                $bus->photo_exterieur
            ]);
        });
    }

    public function estDisponible($dateDepart)
    {
        $dateOnly = \Carbon\Carbon::parse($dateDepart)->format('Y-m-d');

        return !$this->voyages()->whereDate('date_depart', $dateOnly)->exists();
    }
}