<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'nom' => 'Sawadogo',
        //     'prenom' => 'Evrard',
        //     'email' => 'evrard@gmail.com',
        //     'dateNaissance'=>now(),
        //     'lieuNaissance'=>"Ouaga",
        //     'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        // ]);

        Post::factory(100)->create();
    }
}
