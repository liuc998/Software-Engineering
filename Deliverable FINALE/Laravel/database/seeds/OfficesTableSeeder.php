<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('offices')->delete();

        DB::table('offices')->insert([
            [
                'markers_id' => '1',
                'floor' => '1',
                'number' => '121'
            ],
            [
                'markers_id' => '4',
                'floor' => 'PT',
                 'number' => '211'
            ],
            [
                'markers_id' => '2',
                'floor' => '1',
                'number' => '321'
            ],
            [
                'markers_id' => '3',
                'floor' => '2',
                'number' => '018'
            ],
        ]);
    }
}
