<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trajets', function (Blueprint $table) {
            $table->string('statut')->default('Actif');
        });
        
        // Mettre à jour les anciens enregistrements
        DB::table('trajets')->update(['statut' => 'Actif']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trajets', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};
