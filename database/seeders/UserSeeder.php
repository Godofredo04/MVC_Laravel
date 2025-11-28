<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        for($i=0;$i<10;$i++){
            User::create([
                'name'  => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make($faker->password),
            ]);
        }
    }
}
