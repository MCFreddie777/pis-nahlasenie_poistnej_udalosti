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

            <x-ui.label
                key="platná od"
                center
            >
                <ui-datepicker
                    value="{{$contract->valid_from}}"
                    disabled
                />
            </x-ui.label>

            <x-ui.label
                key="platná od"
                center
            >
                <ui-datepicker
                    value="{{$contract->valid_to}}"
                    disabled
                />
            </x-ui.label>

            <x-ui.label
                key="poistník"
                center
                for="user"
            >
                <x-ui.input
                    name="user"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$user->name}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="účel používania"
                center
                for="usage"
            >
                <x-ui.input
                    name="usage"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->usage}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="poistné krytie"
                center
                for="coverage"
            >
                <x-ui.input
                    name="coverage"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->coverage}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">€</span>
            </x-ui.label>

            <h1 class="text-lg mt-16 mb-8 pb-2 border-b-2 border-gray-300 w-5/6 ">
                Údaje o vozidle
            </h1>

            <x-ui.label
                key="výrobca"
                center
                for="manufacturer"
            >
                <x-ui.input
                    name="manufacturer"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->manufacturer}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="model"
                center
                for="model"
            >
                <x-ui.input
                    name="model"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->model}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="karoséria"
                center
                for="body"
            >
                <x-ui.input
                    name="body"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->body}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="farba"
                center
                for="color"
            >
                <x-ui.input
                    name="color"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->color}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="palivo"
                center
                for="fuel"
            >
                <x-ui.input
                    name="fuel"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->fuel}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="typ"
                center
                for="type"
            >
                <x-ui.input
                    name="type"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->type}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="počet osôb"
                center
                for="passenger_quantity"
            >
                <x-ui.input
                    name="passenger_quantity"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->passenger_quantity}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="kategória"
                center
                for="weight_class"
            >
                <x-ui.input
                    name="weight_class"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->weight_class}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="rok výroby"
                center
                for="year"
            >
                <x-ui.input
                    name="year"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->year}}"
                    disabled
                ></x-ui.input>
            </x-ui.label>

            <x-ui.label
                key="objem motora"
                center
                for="engine_displacement"
            >
                <x-ui.input
                    name="engine_displacement"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->engine_displacement}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">cm3</span>
            </x-ui.label>

            <x-ui.label
                key="výkon"
                center
                for="horsepower"
            >
                <x-ui.input
                    name="horsepower"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->horsepower}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">kW</span>
            </x-ui.label>

            <x-ui.label
                key="nosnosť"
                center
                for="weight_rating"
            >
                <x-ui.input
                    name="weight_rating"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle->weight_rating}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">kg</span>
            </x-ui.label>

            <x-ui.label
                key="hodnota vozidla"
                center
                for="value"
            >
                <x-ui.input
                    name="value"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->vehicle_value}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">€</span>
            </x-ui.label>

            <x-ui.label
                key="ročný nájazd"
                center
                for="mileage"
            >
                <x-ui.input
                    name="mileage"
                    type="text"
                    class="text-gray-700 w-96"
                    value="{{$contract->annual_mileage}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">km</span>
            </x-ui.label>

        </div>
    </div>
@stop
