<?php

use Illuminate\Database\Seeder;

class CorporatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        \Illuminate\Support\Facades\DB::table('corporates')->insert([

            'name' => "CSEM SA",
            'contact_firstname' => null,
            'contact_lastname' => null,
            'adresse' => 'Rue Jaquet-Droz 1',
            'npa' => 2002,
            'canton_id' => 12,
            'email' => 'info@csem'

        ]);


        \Illuminate\Support\Facades\DB::table('corporates')->insert([

            'name' => 'MICRONARC',
            'contact_firstname' => "Danick",
            'contact_lastname' => "Bionda",
            'adresse' => "Ruelle Du Peyrou 4",
            'npa' => 2002,
            'canton_id' => 12,
            'email' => "info@micronarc.ch"

        ]);
    }
}
