<?php

namespace App\Http\Controllers;

use App\Contract;
use App\InsuranceEvent as Event;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;

class InsuranceEventController extends Controller
{
    public function index()
    {
        $events = Gate::allows('admin') ?
            Event::all() :
            Event::whereIn(
                'contract_id',
                Contract::where('user_id', Auth::id())->pluck('id')
            )->get();

        return view('events.index')
            ->with('events', $events);
    }

    public function create(Request $request)
    {
        $contract = Contract::findOrFail($request['id']);

        if (!Gate::allows('admin') && $contract->user->id != Auth::id())
            abort(404);

        return view('events.create')
            ->with('contract', $contract);
    }

    public function show(Request $request)
    {
        $event = Event::findOrFail($request['id']);

        if (!Gate::allows('admin') && $event->contract->user->id != Auth::id())
            abort(404);

        return view('events.detail')
            ->with('event', $event);
    }
}
