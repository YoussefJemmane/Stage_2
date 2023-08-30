<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('postes')->insert([
            [
                'nom' => 'CEO',
            ],
            [
                'nom' => 'Operateur',
            ],
            [
                'nom' => 'Directeur Technique',
            ],
            [
                'nom' => 'Responsable Admin',
            ],
            [
                'nom' => 'Product Manager',
            ]

        ]);
    }
}
