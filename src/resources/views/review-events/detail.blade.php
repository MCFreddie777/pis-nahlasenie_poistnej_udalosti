@extends('master')

@section('title',"Poistná udalosť č.". $event->id)

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 ">

            <div class="flex flex-row items-center mb-10 ">

                <h1
                    class="text-2xl"
                >
                    Poistná udalosť č. {{  $event->id }}
                </h1>
                <x-ui.status-icon
                    class="ml-5"
                    :status="$event->status"
                ></x-ui.status-icon>
                {{$event->status}}

            </div>

            <h1 class="text-lg mb-8 pb-2 border-b-2 border-gray-300 w-1/4">
                Údaje o dopravnej nehode
            </h1>


            {{-- datum --}}
            <x-ui.label
                key="dátum"
                center
                for="date"
            >
                <x-ui.datepicker
                    value="{{$event->date}}"
                    disabled
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
                    value="{{$event->place}}"
                    disabled
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
                    value="{{$event->cost}}"
                    disabled
                ></x-ui.input>
                <span class="ml-3 text-gray-500 text-sm">€</span>
            </x-ui.label>


            <h1 class="text-lg mt-16 mb-8 pb-2 border-b-2 border-gray-300 w-1/4">
                Údaje o účastníkoch
            </h1>

            <div class="flex flex-row">

                {{-- Vodic A --}}
                <div class="w-1/2 border border-gray-300 rounded p-5 mr-10">


                    <h1 class="text-lg">
                        Vodič A
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
                            value="{{$event->drivers[0]->first_name}}"
                            disabled
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
                            value="{{$event->drivers[0]->last_name}}"
                            disabled
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
                            value="{{$event->drivers[0]->national_identity_number}}"
                            disabled
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
                            value="{{$event->drivers[0]->address}}"
                            disabled
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
                            value="{{$event->drivers[0]->tel}}"
                            disabled
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
                            value="{{$event->drivers[0]->licence->licence_id}}"
                            disabled
                        ></x-ui.input>
                    </x-ui.label>

                    {{-- platnost od --}}
                    <x-ui.label
                        key="platnosť od"
                        center
                        for="valid_from"
                    >
                        <x-ui.datepicker
                            value="{{$event->drivers[0]->licence->valid_from}}"
                            disabled
                        />
                    </x-ui.label>

                    {{-- platnost do --}}
                    <x-ui.label
                        key="platnosť do"
                        center
                        for="valid_to"
                    >
                        <x-ui.datepicker
                            value="{{$event->drivers[0]->licence->valid_to}}"
                            disabled
                        />
                    </x-ui.label>


                    <x-ui.label
                        key="skupina"
                        center
                        class="mt-2"
                    >
                        @foreach(DrivingLicenceGroupsSeeder::$groups as $group)
                            <x-ui.checkbox
                                text="{{$group}}"
                                name="group[v0][]"
                                :checked="in_array($group,$event->drivers[0]->licence->groupNames)"
                                disabled
                            ></x-ui.checkbox>
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
                        for="name"
                    >
                        <x-ui.input
                            name="name"
                            type="text"
                            class="text-gray-700 flex-grow"
                            value="{{$event->drivers[1]->first_name}}"
                            disabled
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
                            value="{{$event->drivers[1]->last_name}}"
                            disabled
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
                            value="{{$event->drivers[1]->national_identity_number}}"
                            disabled
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
                            value="{{$event->drivers[1]->address}}"
                            disabled
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
                            value="{{$event->drivers[1]->tel}}"
                            disabled
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
                            value="{{$event->drivers[1]->licence->licence_id}}"
                            disabled
                        ></x-ui.input>
                    </x-ui.label>

                    {{-- platnost od --}}
                    <x-ui.label
                        key="platnosť od"
                        center
                        for="valid_from"
                    >
                        <x-ui.datepicker
                            value="{{$event->drivers[1]->licence->valid_from}}"
                            disabled
                        />
                    </x-ui.label>

                    {{-- platnost do --}}
                    <x-ui.label
                        key="platnosť do"
                        center
                        for="valid_to"
                    >
                        <x-ui.datepicker
                            value="{{$event->drivers[1]->licence->valid_to}}"
                            disabled
                        />
                    </x-ui.label>

                    <x-ui.label
                        key="skupina"
                        center
                        class="mt-2"
                    >
                        @foreach(DrivingLicenceGroupsSeeder::$groups as $group)
                            <x-ui.checkbox
                                text="{{$group}}"
                                name="group[v1][]"
                                :checked="in_array($group,$event->drivers[1]->licence->groupNames)"
                                disabled
                            ></x-ui.checkbox>
                        @endforeach
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
                disabled
            >{{$event->note}}
            </textarea>

            <form action="" method="POST">
                @csrf

                <div id="reviewReasonWrapper" class="{{ !old('review-note') ? 'hidden' : '' }}">
                    <h1 class="text-lg mt-10 mb-4 pb-2 border-b-2 border-gray-300 w-1/4">
                        Dôvod zamietnutia
                    </h1>

                    <textarea
                        name="review-note"
                        class="text-gray-700 w-full bg-gray-300 p-2 rounded focus:outline-none placeholder-gray-500"
                        rows="4"
                    >{{old('review-note')}}</textarea>
                </div>

                <div class="flex flex-row justify-end mt-10">

                    <x-ui.button
                        class="rounded-full"
                        text="Zamietnuť s dôvodom"
                        secondary
                        type="submit"
                        id="reviewBtn"
                    ></x-ui.button>

                    <x-ui.button
                        class="rounded-full w-24 ml-3"
                        text="Schváliť"
                        primary
                        type="submit"
                    ></x-ui.button>

                </div>
            </form>
        </div>
    </div>
@stop

@section('script')
    <script defer>
        let reviewOpened = {{ old('review-note') ? 'true' : 'false' }};
        const reviewBtn = document.querySelector('#reviewBtn');
        const reviewReasonWrapper = document.querySelector('#reviewReasonWrapper');
        const reviewReasonTextarea = document.querySelector('#reviewReasonWrapper textarea');
        reviewBtn.addEventListener("click", event => {
            if (!reviewOpened) {
                event.preventDefault();
                reviewOpened = true;
                reviewReasonWrapper.classList.remove('hidden');
                reviewReasonTextarea.setAttribute('required', "true");
            }
        });
    </script>
@endsection
