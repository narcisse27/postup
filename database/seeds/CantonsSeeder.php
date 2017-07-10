<?php

use Illuminate\Database\Seeder;

class CantonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantons = [
            ['ZH', 'Zurich'],
            ['BE', 'Bern'],
            ['LU', 'Lucern'],
            ['UR', 'Uri'],
            ['SZ', 'Schwyz'],
            ['OW', 'Obwalden'],
            ['NW', 'Nidwalden'],
            ['GL', 'Glaris'],
            ['ZG', 'Zug'],
            ['FR', 'Fribourg'],
            ['SO', 'Solothurn'],
            ['BS', 'Bâle-Ville'],
            ['BL', 'Bâle-Campagne'],
            ['SH', 'Schaffhous'],
            ['AR', 'Appenzell Rhodes-Extérieures'],
            ['AI', 'Appenzell Rhodes-Intérieures'],
            ['SG', 'St. Gall'],
            ['GR', 'Grisons'],
            ['AG', 'Argovie'],
            ['TG', 'Thurgovie'],
            ['TI', 'Tessin'],
            ['VD', 'Vaud'],
            ['VS', 'Valais'],
            ['NE', 'Neuchâtel'],
            ['GE', 'Genève'],
            ['JU', 'Jura'],
        ];

        foreach ($cantons as $canton)
            \Illuminate\Support\Facades\DB::table('cantons')->insert([
                'name' => $canton[1],
                'abbreviation' => $canton[0]
            ]);
    }
}
