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
        factory(User::class, 20)->create()->each(function (User $user) {

            for ($i = 0; $i <= $this->numOfEvents; $i++) {

                $contract = $user->contracts()->save(
                    factory(Contract::class)
                        ->make([
                            'user_id' => $user->id
                        ])
                );

                factory(InsuranceEvent::class)->create(
                    [
                        'contract_id' => $contract->id,
                        'employee_id' => $user->role->name == 'employee' ? $user->id : NULL,
                    ]
                );
            }
        });
    }
}
