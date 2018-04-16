<?php

use GameSheets\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'nom' => 'Aventure',
        ]);
        Genre::create([
            'nom' => 'Arcade',
        ]);
        Genre::create([
            'nom' => 'Horreur',
        ]);
        Genre::create([
            'nom' => 'Coopération',
        ]);
        Genre::create([
            'nom' => 'Sport',
        ]);
    }
}
