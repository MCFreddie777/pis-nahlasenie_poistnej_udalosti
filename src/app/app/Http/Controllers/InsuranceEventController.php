<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Driver;
use App\DrivingLicence;
use App\InsuranceEvent as Event;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class InsuranceEventController extends Controller
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
    }

    public function index()
    {
        // GET request to REST api/events
        $response = Http::get(env('API_URL') . "/events")['events'];
        if (!$response)
            abort(500);

        $events = Event::hydrate($response);

        // filter not users' events and map their contract attribute
        if (!Gate::allows('admin')) {

            // Get all users' contract
            $response = $this->soapWrapper->call('Contract.getByAttributeValue', [[
                'attribute_name' => 'user_id',
                'attribute_value' => (string)Auth::id(),
                'ids' => []
            ]])->contracts;

            if (!$response)
                abort(500);

            if (isset($response->contract)) {
                $contracts = $response->contract;

                $contract_ids = array_map(function ($contract) {
                    return $contract->id;
                }, $contracts);

                // Filter only those events which are associated with user contracts
                $events = $events->filter(function ($event) use ($contract_ids) {
                    return in_array($event->contract_id, $contract_ids);
                });

                // map contract to the contract model
                $events->map(function ($event) use ($contracts) {
                    return $this->mapDependencies($event, array_filter(
                            $contracts,
                            function ($c) use ($event) {
                                return $c->id == $event->contract_id;
                            }
                        )
                    );
                });
            } else {
                // if no contracts are available, then events are neither
                $events = [];
            }
        }

        return view('events.index')
            ->with('events', $events);
    }

    public function show(Request $request)
    {
        // GET request to REST api/events/{id}
        $response = Http::get(env('API_URL') . "/events/" . $request['id'])['event'];
        if (!$response)
            abort(500);

        $event = $this->mapDependencies(new Event($response));

        $this->checkPermissions($event->contract);

        return view('events.detail')
            ->with('event', $event);
    }

    public function create(Request $request)
    {
        // getById request to SOAP Contract WS
        $response = $this->soapWrapper->call('Contract.getById', [[
            'id' => $request['id']
        ]])->contract;

        if (!$response)
            abort(500);

        $contract = new Contract((array)$response);

        $this->checkPermissions($contract);

        return view('events.create')
            ->with('contract', $contract);
    }

    public function store(Request $request)
    {
        $response = Http::asForm()->post(
            env('API_URL') . "/events/",
            $request->all()
        )->json();

        if (!$response)
            abort(500);

        if (isset($response['success']) && !!$response['success']) {
            session()->put(['success' => ['Poistná udalosť bola vytvorená.']]);
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors($response['errors']);
    }

    private function checkPermissions($item)
    {
        if (!Gate::allows('admin') && $item->user->id != Auth::id())
            abort(404);
    }

    private function mapDependencies($model, $contract = null)
    {
        // If contract not provided, get from the SOAP Contract WS
        if (!$contract) {
            $response = $this->soapWrapper->call('Contract.getById', [[
                'id' => $model->contract_id
            ]])->contract;

            if (!$response)
                abort(500);

            $model->contract = new Contract((array)$response);
        } else {
            $model->contract = reset($contract);
        }

        $model->drivers = array_map(function ($driver) {
            $driverObj = new Driver($driver);
            $driverObj->licence = new DrivingLicence((array)$driverObj->licence);
            return $driverObj;
        }, $model->drivers);

        return $model;
    }
}
