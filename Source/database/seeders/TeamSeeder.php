<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teams')->insert([
            [
                'nom' => 'Team 1',
            ],
            [
                'nom' => 'Team 2',
            ],
            [
                'nom' => 'Team 3',
            ],
        ]);
    }
}
