<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
            'fullname' => 'administrator',
            'rank_id' => null,
            'position_id' => Position::where('name', 'admin')->first()->id ?? null,
            'nrp' => null,
            'phone_number' => null,
        ]);

        User::create([
            'name' => 'danramil',
            'email' => 'danramil@admin.com',
            'password' => bcrypt('12345'),
            'fullname' => 'danramil',
            'rank_id' => null,
            'position_id' => Position::where('name', 'danramil')->first()->id ?? null,
            'nrp' => null,
            'phone_number' => null,
        ]);

        User::create([
            'name' => 'babinsa',
            'email' => 'babinsa@admin.com',
            'password' => bcrypt('12345'),
            'fullname' => 'babinsa',
            'rank_id' => null,
            'position_id' => Position::where('name', 'babinsa')->first()->id ?? null,
            'nrp' => null,
            'phone_number' => null,
        ]);
    }
}
