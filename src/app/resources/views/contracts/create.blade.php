@extends('master')

@section('title','Nová zmluva')

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6">
            <form action="/contracts" method="POST">
                @csrf

                <input
                    type="text"
                    class="text-2xl border-b-2 border-gray-300 focus:outline-none focus:border-yellow-500"
                    name="name"
                    disabled
                    value="{{ old('name',"Nová zmluva") }}"
                >

                <x-ui.button
                    class="rounded-full w-24 mt-10"
                    text="Uložiť"
                    primary
                    disabled
                    type="submit"
                ></x-ui.button>
            </form>
        </div>
    </div>
@stop
