@extends('master')

@section('title',"Zmluva č.". $contract->id)

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">

            <h1
                class="text-2xl mb-10"
            >
                Zmluva č. {{  $contract->id }}
            </h1>
        </div>
    </div>
@stop
