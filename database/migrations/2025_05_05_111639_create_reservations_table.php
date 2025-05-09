<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('qr_code_path')->nullable()->change();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('voyage_id')->constrained();
            $table->integer('numero_siege');
            $table->enum('statut', ['En attente', 'Confirmée', 'Annulée'])->default('En attente');
            $table->foreignId('siege_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['voyage_id', 'numero_siege']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
