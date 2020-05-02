<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;

class InsuranceEventController extends Controller
{
    public function create(Request $request)
    {
        $contract = Contract::findOrFail($request['id']);

        if (!Gate::allows('admin') && $contract->user->id != Auth::id())
            abort(404);

        return view('events.create')
            ->with('contract', $contract);
    }
}
