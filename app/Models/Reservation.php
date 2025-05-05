<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reservation extends Model
{
    protected $fillable = ['code', 'qr_code_path', 'client_id', 'agence_id', 'voyage_id', 'numero_siege', 'statut'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->code = self::generateCode($model->agence);
            $model->generateQrCode();
            $model->client_id = auth()->id();
        });
    }

    private static function generateCode(Agence $agence)
    {
        $count = Reservation::where('agence_id', $agence->id)
                 ->whereYear('created_at', now()->year)
                 ->count() + 1;

        return sprintf("%s-%04d-%02d", 
            $agence->code_agence, 
            $count, 
            now()->format('y')
        );
    }

    private function generateQrCode()
    {
        $qrContent = json_encode([
            'code' => $this->code,
            'client' => $this->client_id,
            'siege' => $this->numero_siege,
            'voyage' => $this->voyage_id
        ]);

        $fileName = "qrcodes/{$this->code}.svg";
        Storage::disk('public')->put($fileName, QrCode::size(300)->generate($qrContent));
        
        $this->qr_code_path = $fileName;
    }

    // Relations
    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function agence() {
        return $this->belongsTo(Agence::class);
    }

    public function voyage() {
        return $this->belongsTo(Voyage::class);
    }

    public function getQrCodeUrlAttribute()
    {
        return Storage::url($this->qr_code_path);
    }
}
