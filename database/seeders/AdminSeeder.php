<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
{
    // Vérifie si l'utilisateur admin existe déjà
    $user = \App\Models\User::firstOrCreate(
        ['email' => 'ronel@admin.com'],
        [
            'name' => 'Ronel Root',
            'password' => \Illuminate\Support\Facades\Hash::make('je nick les 7 opps'),
            'role' => 'admin',
            'telephone' => '123456789',
        ]
    );

    // Crée ou met à jour le profil admin associé
    \App\Models\Admin::updateOrCreate(
        ['user_id' => $user->id],
        [
            'nom' => 'Ronel',
            'prenom' => 'Root',
        ]
    );
}
}