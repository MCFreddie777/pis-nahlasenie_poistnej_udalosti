<?php

namespace App\Http\Controllers;

use App\Contract;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Gate;

class ContractController extends Controller
{
    public function index()
    {
        $this->checkPermissions();

        // GET request to REST api/contracts
        $response = Http::get(env('API_URL') . "/contracts")['contracts'];

        if (!$response)
            abort(500);

        $contracts = Contract::hydrate($response);

        // Filter only users' contracts
        if (!Gate::allows('admin'))
            $contracts = $contracts->filter(function ($contract) {
                return $contract->user_id === Auth::id();
            });

        return view('contracts.index')
            ->with('contracts', $contracts);
    }

    public function show(Request $request)
    {
        $this->checkPermissions();

        // GET request to REST api/contracts/{id}
        $response = Http::get(env('API_URL') . "/contracts/" . $request->id)['contract'];

        if (!$response)
            abort(500);

        $contract = new Contract($response);

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
