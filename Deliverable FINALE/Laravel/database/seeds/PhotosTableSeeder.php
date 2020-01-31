<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('photos')->delete();

        DB::table('photos')->insert([
            [
                'markers_id' => '7',
                'link' => 'localhost\IngSoftware\database\foto'
            ],
            [
                'markers_id' => '7',
                'link' => 'localhost\IngSoftware\database\foto'
            ],
            [
                'markers_id' => '8',
                'link' => 'localhost\IngSoftware\database\foto'
            ],
            [
                'markers_id' => '8',
                'link' => 'localhost\IngSoftware\database\foto'
            ],
        ]);
    }
}
