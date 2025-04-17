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
        Schema::table('agences', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom_commercial')->after('user_id');
            $table->string('logo')->nullable()->after('nom_commercial');
            $table->string('localisation')->after('logo');
            $table->string('devise')->nullable()->after('localisation');
            $table->boolean('is_verified')->default(false)->after('devise');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agences', function (Blueprint $table) {
            //
        });
    }
};
