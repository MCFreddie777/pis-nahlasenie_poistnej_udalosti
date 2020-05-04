<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Driver;
use App\DrivingLicence;
use App\DrivingLicenceGroup;
use App\InsuranceEvent as Event;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class InsuranceEventController extends Controller
{
    public function index()
    {
        // GET request to REST api/events
        $response = Http::get(env('API_URL') . "/events")['events'];
        $events = Event::hydrate($response);

        // filter not users' events and map their contract attribute
        if (!Gate::allows('admin'))
            $events = $events->filter(function ($event) {
                return ($event->contract['user_id'] === Auth::id());
            });

        // map contract to the contract model
        $events->map(function ($event) {
            return $this->mapDependencies($event);
        });

        return view('events.index')
            ->with('events', $events);
    }

    public function show(Request $request)
    {
        // GET request to REST api/events/{id}
        $response = Http::get(env('API_URL') . "/events/" . $request->id)['event'];
        $event = $this->mapDependencies(new Event($response));

        $this->checkPermissions($event->contract);

        return view('events.detail')
            ->with('event', $event);
    }

    public function create(Request $request)
    {
        // GET request to REST api/contracts/{id}
        $response = Http::get(env('API_URL') . "/contracts/" . $request->id)['contract'];
        $contract = new Contract($response);

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

    private function mapDependencies($model)
    {
        $model->contract = new Contract($model->contract);

        $model->drivers = array_map(function ($driver) {
            $driverObj = new Driver($driver);
            $driverObj->licence = new DrivingLicence((array)$driverObj->licence);
            return $driverObj;
        }, $model->drivers);

        return $model;
    }
}
