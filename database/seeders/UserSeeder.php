<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers

use Illuminate\Support\Facades\Schema;

// Models

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        for($i = 0; $i < 14; $i++) {
            $firstName = fake()->firstName();
            $lastName = fake()->lastName();
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => fake()->email(),
                'password' => 'password',
                'p_iva' => '01234567891',
                
            ]);
        }
    }
}
