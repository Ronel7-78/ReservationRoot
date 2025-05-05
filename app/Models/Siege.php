<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siege extends Model
{
    use HasFactory;
    protected $fillable = ['bus_id', 'numero', 'disponible'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
