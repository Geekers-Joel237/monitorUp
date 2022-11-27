<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Action::factory(100)->create();
        \App\Models\Organisation::factory(100)->create();
        \App\Models\Categorie::factory(100)->create();
        \App\Models\Ressource::factory(100)->create();
        \App\Models\Emprunter::factory(100)->create();
        \App\Models\Reserver::factory(100)->create();



        // \App\Models\Historique::factory(20)->create();
        // \App\Models\Notification::factory(20)->create();
        \App\Models\User::factory()->create([
            'noms' => 'admin',
            'prenoms' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin',

        ]);
    }
}
