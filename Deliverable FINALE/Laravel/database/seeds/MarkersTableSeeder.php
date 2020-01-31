<?php

use Illuminate\Database\Seeder;

class MarkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markers')->delete();

        DB::table('markers')->insert([
            [
                'name' => 'Love.Fish',
                'address' => '580 Darling Street, Rozelle, NSW',
                'lat' => '-33.861034',
                'lng' => '151.171936',
                'type' => 'restaurant',
                'services_id' => '2'
            ],
            [
                'name' => 'Young Henrys',
                'address' => '76 Wilford Street, Newtown, NSW',
                'lat' => '-33.898113',
                'lng' => '151.174469',
                'type' => 'bar',
                'services_id' => '1'
            ],
            [
                'name' => 'Hunter Gatherer',
                'address' => 'Greenwood Plaza, 36 Blue St, North Sydney NSW',
                'lat' => '-33.840282',
                'lng' => '151.207474',
                'type' => 'bar',
                'services_id' => '1'
            ],
            [
                'name' => 'The Potting Shed',
                'address' => '7A, 2 Huntley Street, Alexandria, NSW',
                'lat' => '-33.910751',
                'lng' => '151.194168',
                'type' => 'bar',
                'services_id' => '1'
            ],
            [
                'name' => 'Nomad',
                'address' => '16 Foster Street, Surry Hills, NSW',
                'lat' => '-33.879917',
                'lng' => '151.210449',
                'type' => 'bar',
                'services_id' => '1'
            ],
            [
                'name' => 'Three Blue Ducks',
                'address' => '43 Macpherson Street, Bronte, NSW',
                'lat' => '-33.906357',
                'lng' => '151.263763',
                'type' => 'restaurant',
                'services_id' => '2'
            ],
            [
                'name' => 'Blocco 1',
                'address' => '13 Via Vetoio, Coppito, AQ',
                'lat' => '-33.906357',
                'lng' => '151.263763',
                'type' => 'building',
                'services_id' => '4'
            ],
            [
                'name' => 'Blocco 2',
                'address' => '14 Via Vetoio, Coppito, AQ',
                'lat' => '-33.906357',
                'lng' => '151.263763',
                'type' => 'building',
                'services_id' => '4'
            ],
        ]);
    }
}
