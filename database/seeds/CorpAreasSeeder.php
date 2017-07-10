<?php

use Illuminate\Database\Seeder;

class CorpAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relations = [
            [0,1],
            [0,2],
            [1,3],
            [1,4]
        ];

        foreach ($relations as $relation)
        {

            \Illuminate\Support\Facades\DB::table('corp__areas')->insert([

                'corporate_id' => $relation[0],
                'area_id' => $relation[1]

            ]);
        }
    }
}
