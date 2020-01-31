<?php

use Illuminate\Database\Seeder;

class DegreecoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('degreecourses')->delete();

        DB::table('degreecourses')->insert([
            [
                'departments_id' => '1',
                'name' => 'Informatica'
            ],
            [
                'departments_id' => '2',
                'name' => 'Fisica'
            ],
            [
                'departments_id' => '1',
                'name' => 'Matematica'
            ],
        ]);
    }
}
