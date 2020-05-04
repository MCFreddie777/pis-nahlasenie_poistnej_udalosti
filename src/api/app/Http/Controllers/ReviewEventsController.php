<?php

namespace App\Http\Controllers;

use App\Contract;
use App\InsuranceEvent as Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewEventsController extends Controller
{
    public function store(Request $request)
    {
        // TODO
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
}
