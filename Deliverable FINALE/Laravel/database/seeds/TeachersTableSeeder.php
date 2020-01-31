<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('teachers')->delete();

        DB::table('teachers')->insert([
            [
                'name' => 'Mario',
                'surname' => 'Biondi',
                'offices_id' => '1'
            ],
            [
                'name' => 'Matteo',
                'surname' => 'Brambilla',
                'offices_id' => '2'
            ],
            [
                'name' => 'Stefano',
                'surname' => 'Amadori',
                'offices_id' => '3'
            ],
            [
                'name' => 'Alessandro',
                'surname' => 'Gabbana',
                'offices_id' => '4'
            ],
        ]);
    }
}
