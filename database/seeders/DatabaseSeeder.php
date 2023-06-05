<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Despesa;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Alberto Gomes da Silva',
            'email' => 'albertogomesdasilva@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        \App\Models\User::factory(10)->create();
        
        Despesa::factory(10)->create();
        
        Property::factory(50)->create();
    }
}
