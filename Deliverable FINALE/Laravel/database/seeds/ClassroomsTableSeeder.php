<?php

use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('classrooms')->delete();

        DB::table('classrooms')->insert([
            [
                'name' => 'Aula magna',
                'number' => '1.7',
                'floor' => 'PT',
                'markers_id' => '1'
            ],
            [
                'number' => '1.9',
                'name' => '',
                'floor' => '1',
                'markers_id' => '2'
            ],
            [
                'number' => '1.10',
                'name' => '',
                'floor' => '3',
                'markers_id' => '4'
            ],
        ]);
    }
}
