<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Agence;

class Reservation extends Model
{
    protected $fillable = ['code', 'qr_code_path', 'client_id', 'agence_id', 'voyage_id', 'numero_siege', 'statut'];

    protected static function boot()
    {
        parent::boot();

        //static::creating(function ($model) {
        //    $model->code = self::generateCode($model->agence);
        //    $model->generateQrCode();
        //    $model->client_id = auth()->user()->client->id;
        //});
    }

    protected function generateQrCode()
    {
        $qrContent = json_encode([
            'code' => $this->code,
            'client' => $this->client_id,
            'siege' => $this->numero_siege,
            'voyage' => $this->voyage_id
        ]);

        $url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($qrContent);
        $qrImage = file_get_contents($url);

        $fileName = "qrcodes/{$this->code}.png";
        Storage::disk('public')->put($fileName, $qrImage);

        $this->qr_code_path = $fileName;
    }


    public static function generateCode(Agence $agence)
{
    $year = now()->format('y');
    $count = self::where('agence_id', $agence->id)
        ->whereYear('created_at', now()->year)
        ->count() + 1;

    return sprintf("%s-%04d-%s", $agence->code_agence, $count, $year);
}





    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'confirmé' => 'success',
            'en attente' => 'warning',
            'annulé' => 'danger',
            default => 'secondary'
        };
    }
    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }

    public function getQrCodeUrlAttribute()
    {
        return Storage::url($this->qr_code_path);
    }
}