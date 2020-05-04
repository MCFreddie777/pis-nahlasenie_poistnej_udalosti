<?php

use App\DrivingLicenceGroup;
use Illuminate\Database\Seeder;

class DrivingLicenceGroupsSeeder extends Seeder
{
    public static $groups = ['A', 'AM', 'A1', 'A2', 'B', 'C', 'D', 'T'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (DrivingLicenceGroupsSeeder::$groups as $group)
            factory(DrivingLicenceGroup::class)->create(['name' => $group]);
    }
}
