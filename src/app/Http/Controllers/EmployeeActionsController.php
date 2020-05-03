<?php

namespace App\Http\Controllers;

use App\Contract;
use App\InsuranceEvent as Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmployeeActionsController extends Controller
{
    public function indexEvents()
    {
        $this->checkPermissions();

        $events = Event::whereNotIn('status',['vybavená'])->get();

        return view('review-events.index')
            ->with('events', $events);
    }

    public function showEvents(Request $request)
    {
        $this->checkPermissions();

        $event = Event::findOrFail($request['id']);

        return view('review-events.detail')
            ->with('event', $event);
    }

    public function checkPermissions()
    {
        if (Gate::none(['employee', 'admin']))
            abort(404);
    }
}
