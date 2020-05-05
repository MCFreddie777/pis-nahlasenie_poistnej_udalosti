<?php

use App\Contract;
use App\InsuranceEvent;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private $numOfEvents = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
    }
}
