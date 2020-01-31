<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('departments')->delete();

        DB::table('departments')->insert([
            [
                'universities_id' => '1',
                'name' => 'DISIM'
            ],
            [
                'universities_id' => '1',
                'name' => 'DISFC'
            ],
        ]);
    }
}
