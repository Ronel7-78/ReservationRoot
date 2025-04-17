<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
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
}
