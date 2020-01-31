<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServicesTableSeeder::class);
        $this->call(MarkersTableSeeder::class);
        $this->call(UniversitiesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(DegreecoursesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(ClassroomsTableSeeder::class);
        $this->call(MarkershasdegreecoursesTableSeeder::class);
    }
}
