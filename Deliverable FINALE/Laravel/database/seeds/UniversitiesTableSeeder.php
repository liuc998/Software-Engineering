<?php

use Illuminate\Database\Seeder;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->delete();

        DB::table('universities')->insert(
            [
                'name' => 'Università degli Studi dell Aquila'
            ],
        );
    }
}
