@extends('master')

@section('title','Vytvoriť novú udalosť')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/contracts" method="POST">
                @csrf

                <h1 class="text-2xl mb-10">
                    Vytvoriť novú udalosť
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
                    <x-ui.datepicker/>
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

                            <x-ui.checkbox
                                id="fillUserCheckBox"
                                text="Vyplniť údaje poistníka"
                                reversed
                            ></x-ui.checkbox>

                        </div>

                        <x-ui.label
                            key="meno"
                            center
                            for="name"
                        >
                            <x-ui.input
                                name="name"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('name')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="priezvisko"
                            center
                            for="lastname"
                        >
                            <x-ui.input
                                name="lastname"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('lastname')"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- nid - national identification number --}}
                        <x-ui.label
                            key="rodné číslo"
                            center
                            for="nid"
                        >
                            <x-ui.input
                                name="nid"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('nid')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="adresa"
                            center
                            for="address"
                        >
                            <x-ui.input
                                name="address"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('address')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="telefónne číslo"
                            center
                            for="phone"
                        >
                            <x-ui.input
                                name="phone"
                                type="tel"
                                class="text-gray-700 flex-grow"
                                required
                                pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                :value="old('phone')"
                            ></x-ui.input>
                        </x-ui.label>


                        <h1 class="text-md my-5">
                            Vodičský preukaz
                        </h1>

                        <x-ui.label
                            key="číslo"
                            center
                            for="licensenumber"
                        >
                            <x-ui.input
                                name="licensenumber"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('licensenumber')"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- platnost od --}}
                        <x-ui.label
                            key="platnosť od"
                            center
                            for="valid_from"
                        >
                            <x-ui.datepicker/>
                        </x-ui.label>

                        {{-- platnost do --}}
                        <x-ui.label
                            key="platnosť do"
                            center
                            for="valid_to"
                        >
                            <x-ui.datepicker/>
                        </x-ui.label>

                        <x-ui.label
                            key="skupina"
                            center
                            class="mt-2"
                        >
                            <x-ui.checkbox text="A" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="AM" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="A1" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="A2" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="B" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="C" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="D" name="group[v1][]"></x-ui.checkbox>
                            <x-ui.checkbox text="T" name="group[v1][]"></x-ui.checkbox>
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
                            for="name"
                        >
                            <x-ui.input
                                name="name"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('name')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="priezvisko"
                            center
                            for="lastname"
                        >
                            <x-ui.input
                                name="lastname"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('lastname')"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- nid - national identification number --}}
                        <x-ui.label
                            key="rodné číslo"
                            center
                            for="nid"
                        >
                            <x-ui.input
                                name="nid"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('nid')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="adresa"
                            center
                            for="address"
                        >
                            <x-ui.input
                                name="address"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('address')"
                            ></x-ui.input>
                        </x-ui.label>

                        <x-ui.label
                            key="telefónne číslo"
                            center
                            for="phone"
                        >
                            <x-ui.input
                                name="phone"
                                type="tel"
                                class="text-gray-700 flex-grow"
                                required
                                pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                :value="old('phone')"
                            ></x-ui.input>
                        </x-ui.label>


                        <h1 class="text-md my-5">
                            Vodičský preukaz
                        </h1>

                        <x-ui.label
                            key="číslo"
                            center
                            for="licensenumber"
                        >
                            <x-ui.input
                                name="licensenumber"
                                type="text"
                                class="text-gray-700 flex-grow"
                                required
                                :value="old('licensenumber')"
                            ></x-ui.input>
                        </x-ui.label>

                        {{-- platnost od --}}
                        <x-ui.label
                            key="platnosť od"
                            center
                            for="valid_from"
                        >
                            <x-ui.datepicker/>
                        </x-ui.label>

                        {{-- platnost do --}}
                        <x-ui.label
                            key="platnosť do"
                            center
                            for="valid_to"
                        >
                            <x-ui.datepicker/>
                        </x-ui.label>

                        <x-ui.label
                            key="skupina"
                            center
                            class="mt-2"
                        >

                            <x-ui.checkbox text="A" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="AM" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="A1" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="A2" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="B" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="C" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="D" name="group[v2][]"></x-ui.checkbox>
                            <x-ui.checkbox text="T" name="group[v2][]"></x-ui.checkbox>
                        </x-ui.label>
                    </div>
                </div>


                <h1 class="text-lg mt-16 mb-4 pb-2 border-b-2 border-gray-300 w-1/4">
                    Opis udalosti
                </h1>

                <textarea
                    name="description"
                    class="text-gray-700 w-full bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500"
                    rows="4"
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
