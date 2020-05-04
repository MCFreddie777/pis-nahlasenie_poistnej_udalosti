<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Driver;
use App\DrivingLicence;
use App\InsuranceEvent as Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewEventsController extends Controller
{
    public function index()
    {
        $this->checkPermissions();

        // REST request on api/events
        $response = Http::get(env('API_URL') . "/events")['events'];
        $events = Event::hydrate($response);

        if (!Gate::allows('admin'))
            // filter only unfinished unassigned or employees' events
            $events = $events->filter(function ($event) {
                return (
                    ($event->employee_id === Auth::id() || !$event->employee_id)
                    && (!in_array($event->status, ['vybavená', 'zamietnutá']))
                );
            });

        // map contract to the contract model
        $events->map(function ($event) {
            return $this->mapDependencies($event);
        });

        return view('review-events.index')
            ->with('events', $events);
    }

    public function show(Request $request)
    {
        // REST request on api/events/{id}
        $response = Http::get(env('API_URL') . "/events/" . $request->id)['event'];
        $event = $this->mapDependencies(new Event($response));

        $this->checkPermissions($event);

        return view('review-events.detail')
            ->with('event', $event);
    }

    public function handle(Request $request)
    {
        // TODO
    }

    public function checkPermissions($event = null)
    {
        if (!$event) {
            if (Gate::none(['employee', 'admin']))
                abort(404);
        } else {
            // Show employee only their or unassigned events
            if (
                Gate::allows('employee') &&
                ($event->employee_id != Auth::id() && $event->employee_id)
            )
                abort(404);
        }
    }

    private function mapDependencies($model)
    {
        $model->contract = new Contract($model->contract);

        $model->drivers = array_map(function ($driver) {
            $driverObj = new Driver($driver);
            $driverObj->licence = new DrivingLicence((array) $driverObj->licence);
            return $driverObj;
        }, $model->drivers);

        return $model;
    }
}
