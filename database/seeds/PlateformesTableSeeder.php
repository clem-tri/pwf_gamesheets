<?php

use GameSheets\Models\Plateforme;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 23/04/2018
 * Time: 09:59
 */

class PlateformesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plateforme::create([
            'nom' => 'PC',
        ]);
        Plateforme::create([
            'nom' => 'PS4',
        ]);
        Plateforme::create([
            'nom' => 'XBOX ONE',
        ]);
        Plateforme::create([
            'nom' => 'Switch',
        ]);
        Plateforme::create([
            'nom' => 'Nintendo DS',
        ]);
        Plateforme::create([
            'nom' => 'Android',
        ]);
    }

}