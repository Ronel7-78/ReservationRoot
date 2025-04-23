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
    public function up()
{
    Schema::table('buses', function (Blueprint $table) {
        $table->string('statut')->default('Actif');
    });
    
    // Mettre à jour les anciens enregistrements
    DB::table('buses')->update(['statut' => 'Actif']);
}

public function down()
{
    Schema::table('buses', function (Blueprint $table) {
        $table->dropColumn('statut');
    });
}
};
