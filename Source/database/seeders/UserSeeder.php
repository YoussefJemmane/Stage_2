<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nom' => 'nabil',
                'prenom' => 'el khalfi',
                'date_travail' => '2021-06-01',
                'poste' => 'CEO',
                'salaire' => 20000,
                'cin' => 'employee_images/cin/1.jpg',
                'email' => 'admin@sib.com',
                'password' => bcrypt('admin'),
            ],
            [
                'nom' => 'hamza',
                'prenom' => 'el khalfi',
                'date_travail' => '2021-06-01',
                'poste' => 'Operateur',
                'salaire' => 20000,
                'cin' => 'employee_images/cin/1.jpg',
                'email' => 'hamza@sib.com',
                'password' => bcrypt('hamza'),
            ],
            [
                'nom' => 'khawla',
                'prenom' => 'el khalfi',
                'date_travail' => '2021-06-01',
                'poste' => 'Responsable Admin',
                'salaire' => 20000,
                'cin' => 'employee_images/cin/1.jpg',
                'email' => 'khawla@sib.com',
                'password' => bcrypt('khawla'),
            ],
            [
                'nom' => 'marouane',
                'prenom' => 'el khalfi',
                'date_travail' => '2021-06-01',
                'poste' => 'Directeur Technique',
                'salaire' => 20000,
                'cin' => 'employee_images/cin/1.jpg',
                'email' => 'marouane@sib.com',
                'password' => bcrypt('marouane'),
            ],
            [
                'nom' => 'Ikbal',
                'prenom' => 'el khalfi',
                'date_travail' => '2021-06-01',
                'poste' => 'Project Manager',
                'salaire' => 20000,
                'cin' => 'employee_images/cin/1.jpg',
                'email' => 'ikbal@sib.com',
                'password' => bcrypt('ikbal'),
            ],
        ]);
    }
}
