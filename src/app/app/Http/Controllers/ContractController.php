<?php

namespace App\Http\Controllers;

use App\Contract;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContractController extends Controller
{
    public function index()
    {
        $this->checkPermissions();

        $contracts = Gate::allows('admin') ?
            Contract::all() :
            Contract::where('user_id', Auth::id())->get();

        return view('contracts.index')
            ->with('contracts', $contracts);
    }

    public function show(Request $request)
    {
        $this->checkPermissions();

        $contract = Contract::findOrFail($request['id']);

        if (!Gate::allows('admin') && $contract->user->id != Auth::id())
            abort(404);

        return view('contracts.detail')
            ->with('contract', $contract);
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function checkPermissions()
    {
        if (Gate::none(['user', 'admin']))
            abort(404);
    }
}
