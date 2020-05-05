<?php

namespace App\Http\Controllers;

use App\Contract;
use App\User;
use App\Vehicle;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;
use Artisaninweb\SoapWrapper\SoapWrapper;

class ContractController extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;

        $this->soapWrapper->add('Contract', function ($service) {
            $service
                ->wsdl('http://pis.predmety.fiit.stuba.sk/pis/ws/Students/Team073Contract?WSDL')
                ->trace(true);
        });

        $this->soapWrapper->add('Vehicle', function ($service) {
            $service
                ->wsdl('http://pis.predmety.fiit.stuba.sk/pis/ws/Students/Team073Vehicle?WSDL')
                ->trace(true);
        });
    }

    public function index()
    {
        $this->checkPermissions();

        // getAll request to SOAP Contract WS
        $response = $this->soapWrapper->call('Contract.getAll')->contracts->contract;

        if (!$response)
            abort(500);

        $contracts = Contract::hydrate($response);

        // Filter only users' contracts
        if (!Gate::allows('admin'))
            $contracts = $contracts->filter(function ($contract) {
                return $contract->user_id === Auth::id();
            });

        return view('contracts.index')
            ->with('contracts', $contracts);
    }

    public function show(Request $request)
    {
        $this->checkPermissions();

        // getById request to SOAP Contract WS
        $response = $this->soapWrapper->call('Contract.getById', [[
            'id' => $request['id']
        ]])->contract;

        if (!$response)
            abort(500);

        $contract = new Contract((array)$response);

        // getById request to SOAP Vehicle WS
        $response = $this->soapWrapper->call('Vehicle.getById', [[
                'id' => $contract->vehicle_id,
            ]]
        )->vehicle;

        if (!$response)
            abort(500);

        $contract->vehicle = new Vehicle((array)$response);

        $user = User::findOrFail($contract->user->id);

        if (!Gate::allows('admin') && $user->id != Auth::id())
            abort(404);

        return view('contracts.detail')
            ->with('contract', $contract)
            ->with('user', $user);
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function checkPermissions()
    {
        if (Gate::none(['user', 'admin']))
            abort(404);
    }
}
