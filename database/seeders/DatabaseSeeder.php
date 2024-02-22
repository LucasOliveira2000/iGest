<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Produto::factory(30)->create();

         \App\Models\Produto::factory()->create([
             'user_id' => 1,
             'nome' => 'Teste',
             'marca' => 'Tete',
             'quantidade' => '44',
             'valor' => '99',
         ]);
    }
}
