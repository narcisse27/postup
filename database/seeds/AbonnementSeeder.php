<?php

use Illuminate\Database\Seeder;

class AbonnementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


            \Illuminate\Support\Facades\DB::table('abonnements')->insert([
                'name' => 'free',
                'templates_max' => 2,
                'appendices_max' => 5,
                'mails_weekly' => 7
            ]);

            \Illuminate\Support\Facades\DB::table('abonnements')->insert([
                'name' => 'premium',
                'templates_max' => 5,
                'appendices_max' => 8,
                'mails_weekly' => 14
            ]);

    }
}
