<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'admin@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456',[ 'rounds' => 12])
            ]);
        }
        
        if(!User::where('email', 'usuario_cadastrado@example.com')->exists()) {
            User::factory()->create([
                'name' => 'usuario_cadastrado',
                'email' => 'usuario_cadastrado@example.com',
                'password' => Hash::make('123456',[ 'rounds' => 12])
            ]);
        }

        if(!User::where('email', 'novo_usuario@example.com')->exists()) {
            User::factory()->create([
                'name' => 'novo_usuario',
                'email' => 'novo_usuario@example.com',
                'password' => Hash::make('123456',[ 'rounds' => 12])
            ]);
        }
    }
}
