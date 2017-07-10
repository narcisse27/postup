<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'admin',
            'lastname' => 'random lastname',
            'area_id' => 1,
            'adresse' => "random adresse",
            'npa' => 2000,
            'city' => "Neuchâtel",
            'api_token' => 'random1tokenn',
            'email' => 'admin'.'@gmail.com',
            'password' => bcrypt('asdfasdf'),
        ]);
        DB::table('users')->insert([
            'firstname' => 'customer',
            'lastname' => 'random lastname',
            'area_id' => 1,
            'adresse' => "random adresse",
            'npa' => 2000,
            'city' => "Neuchâtel",
            'api_token' => 'random1tokena',

            'email' => 'customer'.'@gmail.com',
            'password' => bcrypt('asdfasdf'),
        ]);
        DB::table('users')->insert([
            'firstname' => 'lead',
            'lastname' => 'random lastname',
            'area_id' => 1,
            'adresse' => "random adresse",
            'npa' => 2000,
            'city' => "Neuchâtel",
            'api_token' => 'random1tokens',

            'email' => 'lead'.'@gmail.com',
            'password' => bcrypt('asdfasdf'),
        ]);
    }
}
