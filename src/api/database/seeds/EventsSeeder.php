<?php

use App\Contract;
use App\InsuranceEvent;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Artisaninweb\SoapWrapper\SoapWrapper;

class EventsSeeder extends Seeder
{
    protected $soapWrapper;
    private $numOfEvents = 3;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;

        $this->soapWrapper->add('Contract', function ($service) {
            $service
                ->wsdl('http://pis.predmety.fiit.stuba.sk/pis/ws/Students/Team073Contract?WSDL')
                ->trace(true);
        });
    }

    public function run()
    {
        // Get all users
        $users = DB::table('users')->get();

        foreach ($users as $user) {

            // Get all users' contract
            $response = $this->soapWrapper->call('Contract.getByAttributeValue', [[
                'attribute_name' => 'user_id',
                'attribute_value' => (string)$user->id,
                'ids' => []
            ]])->contracts;

            // foreach contract create numOfEvents events
            if (isset($response->contract)) {

                foreach ($response->contract as $contract) {
                    factory(InsuranceEvent::class)->create(
                        [
                            'contract_id' => $contract->id,
                            'employee_id' => $user->role_id == 2 ? $user->id : NULL,
                        ]
                    );
                }
            }
        }
    }
}
