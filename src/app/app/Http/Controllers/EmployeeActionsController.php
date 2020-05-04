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

        if (Gate::allows('admin'))
            $events = Event::all();
        else
            $events = Event::
            where(function ($query) {
                return $query->where('employee_id', Auth::id())
                    ->orWhere('employee_id', null);
            })
                ->whereNotIn('status', ['vybavená', 'zamietnutá'])
                ->get();

        return view('review-events.index')
            ->with('events', $events);
    }

    public function showEvent(Request $request)
    {
        $event = Event::findOrFail($request['id']);

        $this->checkPermissions($event);

        return view('review-events.detail')
            ->with('event', $event);
    }

    public function handleReview(Request $request)
    {
        // Find the id
        $event = Event::findOrFail($request['id']);
        $this->checkPermissions($event);

        // Validate request
        $request->validate([
            'review-note' => 'nullable|string',
        ]);

        // Set details
        $event->employee_id = Auth::id();
        if ($request->get('review-note')) {
            $event->review_note = $request->get('review-note');
            $event->status = 'zamietnutá';
        } else {
            $event->status = 'vybavená';
        }

        // Save and handle
        $res = $event->save();

        if ($res) {
            session()->put(['success' => ['Poistná udalosť bola úspešne spracovaná.']]);
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['Nepodarilo sa spracovať poistnú udalosť']);
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
}
