<?php

use Illuminate\Database\Seeder;

class MarkershasdegreecoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('markershasdegreecourses')->delete();

        DB::table('markershasdegreecourses')->insert([
            [
                'markers_id' => '1',
                'degreecourses_id' => '1'
            ],
            [
                'markers_id' => '2',
                'degreecourses_id' => '2'
            ],
            [
                'markers_id' => '3',
                'degreecourses_id' => '3'
            ],
            [
                'markers_id' => '4',
                'degreecourses_id' => '1'
            ],
        ]);
    }
}
