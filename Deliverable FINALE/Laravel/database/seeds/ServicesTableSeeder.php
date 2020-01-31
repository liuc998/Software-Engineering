<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('services')->delete();

        DB::table('services')->insert([
            [
                'important' => FALSE,
                'category' => 'Bar'
            ],
            [
                'important' => TRUE,
                'category' => 'Food'
            ],
            [
                'important' => FALSE,
                'category' => 'Stationers'
            ],
            [
                'important' => TRUE,
                'category' => 'Infrastructure'
            ],
        ]);
    }
}
