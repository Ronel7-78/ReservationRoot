<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_voyages_table.php
public function up()
{
    Schema::create('voyages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('trajet_id')->constrained();
        $table->foreignId('bus_id')->constrained();
        $table->dateTime('date_depart');
        $table->time('heure_depart');
        $table->timestamps();
        
        // Index composite pour éviter les doublons
        $table->unique(['bus_id', 'date_depart']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
