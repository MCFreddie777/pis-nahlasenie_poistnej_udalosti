@extends('master')

@section('title','Vytvoriť novú udalosť')

@php
    $prefill = Request::get('prefill');
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/events" method="POST">
                @csrf

                <input type="hidden" name="contract_id" value="{{Request::get('id')}}">

                <h1 class="text-2xl mb-10">
                    Vytvoriť novú udalosť k poistnej zmluve č. {{ $contract->id }}
                </h1>


                <h1 class="text-lg mb-8 pb-2 border-b-2 border-gray-300 w-1/4">
                    Údaje o dopravnej nehode
                </h1>

                {{-- datum --}}
                <x-ui.label
                    key="dátum"
                    center
                    for="date"
                >
                    <ui-datepicker
                        name="date"
                        value="{{old('date')}}"
                        required
                        @if($errors->has('date')) error @endif
                    />
                </x-ui.label>

                {{-- miesto --}}
                <x-ui.label
                    key="miesto"
                    center
                    for="place"
                >
                    <x-ui.input
                        name="place"
                        type="text"
                        class="text-gray-700 w-96"
                        required
                        :value="old('place')"
                    ></x-ui.input>
                </x-ui.label>

                {{-- skoda --}}
                <x-ui.label
                    key="škoda"
                    center
                    for="cost"
                >
                    <x-ui.input
                        name="cost"
                        type="number"
                        class="text-gray-700"
                        required
                        :value="old('cost')"
                    ></x-ui.input>
                    <span class="ml-3 text-gray-500 text-sm">€</span>
                </x-ui.label>


                <h1 class="text-lg mt-16 mb-8 pb-2 border-b-2 border-gray-300 w-1/4">
                    Údaje o účastníkoch
                </h1>

                <div class="flex flex-row">

                    {{-- Vodic A --}}
                    <div class="w-1/2 border border-gray-300 rounded p-5 mr-10">

                        <div class="flex flex-row justify-between mb-5">

                            <h1 class="text-lg">
                                Vodič A
                            </h1>

                            <div>
                                <ui-checkbox
                                    text="Vyplniť údaje poistníka"
                                    reversed
                                    @if(!!$prefill) checked @endif
                                    redirect="{{ Request::url() .'?'. http_build_query(array_merge(Request::query(), ['prefill' =>(int)!$prefill ]))}}"
                                >
                                </ui-checkbox>
                            </div>
                        </div>

                        <x-ui.label
                            key="meno"
                            center
                            for="v0[first_name]"
                        >
                            <x-ui.input
                                name="v0[first_name]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="$prefill ? Auth::user()->first_name : old('v0.first_name')"
                                error-key="v0.first_name"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="priezvisko"
                            center
                            for="v0[last_name]"
                        >
                            <x-ui.input
                                name="v0[last_name]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="$prefill ? Auth::user()->last_name : old('v0.last_name')"
                                error-key="v0.last_name"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="rodné číslo"
                            center
                            for="v0[national_identity_number]"
                        >
                            <x-ui.input
                                name="v0[national_identity_number]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="$prefill ? Auth::user()->national_identity_number : old('v0.national_identity_number')"
                                error-key="v0.national_identity_number"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="adresa"
                            center
                            for="v0[address]"
                        >
                            <x-ui.input
                                name="v0[address]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="$prefill ? Auth::user()->address : old('v0.address')"
                                error-key="v0.address"
                            ></x-ui.input>
                        </x-ui.label>
                        <x-ui.label
                            key="telefónne číslo"
                            center
                            for="v0[phone]"
                        >
                            <x-ui.input
                                name="v0[phone]"
                                type="tel"
                                class="text-gray-700 flex-grow"
                                :value="$prefill ? Auth::user()->tel : old('v0.phone')"
                                error-key="v0.phone"
                            ></x-ui.input>
                        </x-ui.label>


                        <h1 class="text-md my-5">
                            Vodičský preukaz
                        </h1>

                        <x-ui.label
                            key="číslo"
                            center
                            for="v0[licence_id]"
                        >
                            <x-ui.input
                                name="v0[licence_id]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v0.licence_id')"
                                error-key="v0.licence_id"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- platnost od --}}
                        <x-ui.label
                            key="platnosť od"
                            center
                            for="v0[valid_from]"
                        >
                            <ui-datepicker
                                name="v0[valid_from]"
                                value="{{old('v0.valid_from')}}"
                                required
                                @if($errors->has('v0.valid_from')) error @endif
                            />
                        </x-ui.label>

                        {{-- platnost do --}}
                        <x-ui.label
                            key="platnosť do"
                            center
                            for="valid_to"
                        >
                            <ui-datepicker
                                name="v0[valid_to]"
                                value="{{old('v0.valid_to')}}"
                                required
                                @if($errors->has('v0.valid_to')) error @endif
                            />
                        </x-ui.label>

                        {{-- vystavil --}}
                        <x-ui.label
                            key="vystavil"
                            center
                            for="issued_by"
                        >
                            <x-ui.input
                                name="v0[issued_by]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v0.issued_by')"
                                error-key="v0.issued_by"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="skupina"
                            center
                            class="mt-2"
                        >
                            @foreach(DrivingLicenceGroup::$groups as $group)
                                <ui-checkbox
                                    text="{{$group}}"
                                    name="v0[group][]"
                                    value="{{$group}}"
                                    @if(in_array($group,old('v0.group')??[])) checked @endif
                                    required
                                ></ui-checkbox>
                            @endforeach
                        </x-ui.label>
                    </div>

                    {{-- Vodic B --}}
                    <div class="w-1/2 border border-gray-300 rounded p-5 mr-2">

                        <h1 class="text-lg mb-5">
                            Vodič B
                        </h1>

                        <x-ui.label
                            key="meno"
                            center
                            for="v1[first_name]"
                        >
                            <x-ui.input
                                name="v1[first_name]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.first_name')"
                                error-key="v1.first_name"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="priezvisko"
                            center
                            for="v1[last_name]"
                        >
                            <x-ui.input
                                name="v1[last_name]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.last_name')"
                                error-key="v1.last_name"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="rodné číslo"
                            center
                            for="v1[national_identity_number]"
                        >
                            <x-ui.input
                                name="v1[national_identity_number]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.national_identity_number')"
                                error-key="v1.national_identity_number"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="adresa"
                            center
                            for="v1[address]"
                        >
                            <x-ui.input
                                name="v1[address]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.address')"
                                error-key="v1.address"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="telefónne číslo"
                            center
                            for="v1[phone]"
                        >
                            <x-ui.input
                                name="v1[phone]"
                                type="tel"
                                class="text-gray-700 flex-grow"
                                :value="old('v1.phone')"
                                error-key="v1.phone"
                            ></x-ui.input>
                        </x-ui.label>


                        <h1 class="text-md my-5">
                            Vodičský preukaz
                        </h1>

                        <x-ui.label
                            key="číslo"
                            center
                            for="v1[licence_id]"
                        >
                            <x-ui.input
                                name="v1[licence_id]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.licence_id')"
                                error-key="v1.licence_id"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- platnost od --}}
                        <x-ui.label
                            key="platnosť od"
                            center
                            for="v1[valid_from]"
                        >
                            <ui-datepicker
                                name="v1[valid_from]"
                                value="{{old('v1.valid_from')}}"
                                required
                                @if($errors->has('v1.valid_from')) error @endif
                            />
                        </x-ui.label>

                        {{-- platnost do --}}
                        <x-ui.label
                            key="platnosť do"
                            center
                            for="v1[valid_to]"
                        >
                            <ui-datepicker
                                name="v1[valid_to]"
                                value="{{old('v1.valid_to')}}"
                                required
                                @if($errors->has('v1.valid_to')) error @endif
                            />
                        </x-ui.label>

                        {{-- vystavil --}}
                        <x-ui.label
                            key="vystavil"
                            center
                            for="issued_by"
                        >
                            <x-ui.input
                                name="v1[issued_by]"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('v1.issued_by')"
                                error-key="v1.issued_by"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="skupina"
                            center
                            class="mt-2"
                        >
                            @foreach(DrivingLicenceGroup::$groups as $group)
                                <ui-checkbox
                                    text="{{$group}}"
                                    name="v1[group][]"
                                    value="{{$group}}"
                                    @if(in_array($group,old('v1.group')??[])) checked @endif
                                    required
                                ></ui-checkbox>
                            @endforeach
                        </x-ui.label>
                    </div>
                </div>


                <h1 class="text-lg mt-16 mb-4 pb-2 border-b-2 border-gray-300 w-1/4">
                    Opis udalosti
                </h1>

                <textarea
                    name="description"
                    class="text-gray-700 w-full bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500
                    @if($errors->has('v1.description')) border-2 border-red-500 @endif"
                    rows="4"
                    required
                >{{ old('description') }}</textarea>

                <x-ui.button
                    class="rounded-full w-24 mt-10"
                    text="Odoslať"
                    primary
                    type="submit"
                ></x-ui.button>
            </form>
        </div>
    </div>
@stop
