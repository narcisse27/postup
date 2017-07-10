<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\DB::table('roles')->insert([

            'name' => "premium",
            'display_name' => "membre premium",
            'description' => "les membres premium ont droit à une gestion plus grande de leurs informations ainsi qu'à un envoie de mails hebdomadaire plus grand",

        ]);

        \Illuminate\Support\Facades\DB::table('roles')->insert([

            'name' => "free",
            'display_name' => "membre free",
            'description' => "les membres free ont droit à une gestion restreinte de leurs informations ainsi qu'à un envoi minimum au niveau du mailer",

        ]);

        \Illuminate\Support\Facades\DB::table('roles')->insert([

            'name' => "admin",
            'display_name' => "membre admin",
            'description' => "les admins , sont les modérateurs de postup",

        ]);
    }
}
