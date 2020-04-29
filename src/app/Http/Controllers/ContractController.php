<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index')
            ->with('contracts', $contracts);
    }

    public function show(Request $request)
    {
        $contract = Contract::findOrFail($request['id']);

        return view('contracts.detail')
            ->with('contract', $contract);
    }

    public function create()
    {
        return view('contracts.create');
    }
}
