@extends('layouts.app')

@section('title','Chyba')

@section('master')
    <div class="h-full flex-col bg-gray-200">
        <div class="flex w-full shadow-lg bg-red-600 p-4 h-18">
            <a href="/">
                <h1
                    class="text-2xl text-white inline-block"
                >
                    Poisťovňa s.r.o.
                </h1>
            </a>
        </div>
        <div class="flex flex-col items-center mt-32 leading-tight">
            <span
                class="text-bold text-red-600"
                style="font-size: 10rem;"
            >
                500
            </span>
            <span class="text-bold text-center text-2xl">
                Ups! Niečo sa kolosálne pokazilo.<br/> Nebojte sa, sme proti tomu poistení.
            </span>

            <x-ui.button
                class="rounded-full w-32 h-8 mt-6"
                text="Ísť na domov"
                primary
                type="link"
                href="/"
            >
            </x-ui.button>
        </div>
    </div>
@endsection
