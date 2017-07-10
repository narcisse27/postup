<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(CantonsSeeder::class);
        $this->call(CorpAreasSeeder::class);
        $this->call(TemplateFactorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AbonnementSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
