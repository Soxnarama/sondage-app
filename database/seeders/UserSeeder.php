<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // <-- Assure-toi que cette ligne est présente
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'last_name' => 'Fall',
            'first_name' => 'Soxna',
            'username' => 'soxnarama',
            'mail' => 'soxnarama@gmail.com',
            'password' => Hash::make('password123'),
            'domaine' => 'exemple.com',
        ]);
    }
}
