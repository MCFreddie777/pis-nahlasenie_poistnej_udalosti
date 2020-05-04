<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();
        return response()->json(['contracts' => $contracts]);
    }

    public function get(Request $request)
    {
        $contract = Contract::findOrFail($request['id']);
        return response()->json(['contract' => $contract]);
    }
}
