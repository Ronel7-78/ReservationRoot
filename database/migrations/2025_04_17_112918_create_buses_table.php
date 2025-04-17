<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('buses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('agence_id')->constrained()->onDelete('cascade');
        $table->string('libelle');
        $table->string('immatriculation')->unique();
        $table->enum('type', ['vip', 'standard']);
        $table->integer('nombre_place');
        $table->enum('statut', ['disponible', 'indisponible'])->default('disponible');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
