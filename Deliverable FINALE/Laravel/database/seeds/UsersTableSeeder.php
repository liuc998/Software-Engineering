<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //eliminiamo eventuali utenti già presenti
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'fiscalcode' => 'MCCMTT98C08A535G',
                'name' => 'Mattia',
                'surname' => 'Masci',
                'password' => Hash::make('mattiamas'),
                'email' => 'mascimattia@gmail.com',
                'degreecourses_id' => '1'
            ],
            [
                'fiscalcode' => 'GVNGMN98C98A555H',
                'name' => 'Giovanni',
                'surname' => 'Gemini',
                'password' => Hash::make('giovagem'),
                'email' => 'giovannigemini@gmail.com',
                'degreecourses_id' => '2'
            ],
            [
                'fiscalcode' => 'LUCDLD98C08A535A',
                'name' => 'Luca',
                'surname' => 'Di Laudo',
                'password' => Hash::make('lucadila'),
                'email' => 'luca.dilaudo@gmail.com',
                'degreecourses_id' => '3'
            ],
        ]);
    }
}
