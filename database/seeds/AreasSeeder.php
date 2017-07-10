<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            'Communication',
            'Informatique',
            'Architecture',
            'Publicité',
            'Graphisme'
        ];

        foreach ($areas as $area)
        {
            \Illuminate\Support\Facades\DB::table('areas')->insert([
                'name' => $area
            ]);
        }
    }
}
