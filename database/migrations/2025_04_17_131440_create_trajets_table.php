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
        Schema::create('trajets', function (Blueprint $table) {
            
                $table->id();
                $table->string('ville_depart');
                $table->string('ville_arrivee');
                $table->enum('standing', ['vip', 'classique']);
                $table->decimal('prix', 10, 2);
                $table->foreignId('agence_id')->constrained('agences')->onDelete('cascade');
                $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
