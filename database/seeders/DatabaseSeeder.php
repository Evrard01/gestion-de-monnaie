<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Type;
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
        Type::create([
            "libelle"=> "Administrateur",
            "typable_type"=> "App\\Models\\User",
            "typable_id"=> 1,
        ]);

        \App\Models\User::factory()->create([
            'nom' => 'Sawadogo',
            'prenom' => 'Evrard',
            'email' => 'evrard@gmail.com',
            'type_id'=>1,
            'dateNaissance'=>now(),
            'lieuNaissance'=>"Ouaga",
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        Post::factory(100)->create();

        Type::create([
            "libelle"=> "Client",
            "typable_type"=> "App\\Models\\User",
            "typable_id"=> 1,
        ]);
        Type::create([
            "libelle"=> "Nowpayment",
            "typable_type"=> "App\\Models\\Monaie",
            "typable_id"=> 1,
        ]);
        Type::create([
            "libelle"=> "Perfectmoney",
            "typable_type"=> "App\\Models\\Monaie",
            "typable_id"=> 1,
        ]);
        Type::create([
            "libelle"=> "Depot",
            "typable_type"=> "App\\Models\\Transaction",
            "typable_id"=> 1,
        ]);
        Type::create([
            "libelle"=> "Retrait",
            "typable_type"=> "App\\Models\\Transaction",
            "typable_id"=> 1,
        ]);

    }
}
