<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rank::create(['name' => 'Rank 1']);
        Rank::create(['name' => 'Rank 2']);
        Rank::create(['name' => 'Rank 3']);
    }
}
