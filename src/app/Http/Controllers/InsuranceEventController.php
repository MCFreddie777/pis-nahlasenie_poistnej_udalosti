<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;

class InsuranceEventController extends Controller
{
    public function create(Request $request)
    {
        $contract = Contract::findOrFail($request['id']);

        return view('events.create')
            ->with('contract', $contract);
    }
}
