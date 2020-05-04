@extends('layouts.app')

@section('title','Prihlásenie')

@section('master')

    <div class="h-full flex bg-gray-200">
        <div class="fixed flex w-full shadow-lg bg-red-600 p-4">
            <a href="/">
                <h1
                    class="text-2xl text-white inline-block"
                >
                    Poisťovňa s.r.o.
                </h1>
            </a>
        </div>

        <div class="mx-auto flex justify-center items-center ">

            <div class="w-112 bg-white rounded-lg shadow-xl p-8">

                <h1 class="text-gray-800 text-3xl font-bold pt-3 text-center">Nastaviť nové heslo</h1>

                <form method="POST" action="/password/reset" class="relative mt-10">
                    @csrf

                    @if (session('status'))
                        <p
                            class="text-green-500 absolute text-sm"
                            style="top:-1.5rem"
                        >
                            <span>
                            {{ session('status') }}
                            </span>
                        </p>
                    @endif

                    @if ($errors->any())
                        <p
                            class="text-red-500 absolute text-sm"
                            style="top:-1.5rem"
                        >
                            <span>
                                {{ $errors->all()[0] }}
                            </span>
                        </p>
                    @endif

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="flex items-center pb-3 w-full">
                        <label
                            class="block uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                            for="email"
                        >
                            Email
                        </label>
                        <x-ui.input
                            type="email"
                            name="email"
                            required="true"
                            autofocus="true"
                            class="flex-grow"
                            placeholder="vasa@adresa.sk"
                        >
                        </x-ui.input>
                    </div>

                    <div class="flex items-center pb-3 w-full">
                        <label
                            class="block uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                            for="password"
                        >
                            Nové Heslo
                        </label>
                        <x-ui.input
                            type="password"
                            name="password"
                            class="flex-grow"
                            :required="true"
                            placeholder="••••••••"
                            autocomplete="off"
                        ></x-ui.input>
                    </div>

                    <div class="flex items-center pb-3">
                        <label
                            class="uppercase font-bold text-gray-500 text-sm block w-32 mr-5"
                            for="confirm_password"
                        >
                            Potvrdiť heslo
                        </label>
                        <x-ui.input
                            type="password"
                            name="password_confirmation"
                            :required="true"
                            class="flex-grow"
                            placeholder="••••••••"
                            autocomplete="off"
                            error-key="password"
                        ></x-ui.input>
                    </div>

                    <div class="pt-8 text-center">
                        <button
                            type="submit"
                            class="bg-red-600 py-2 px-6 text-center rounded-full text-white mx-auto hover:bg-red-500 focus:outline-none"
                        >
                            Uložiť heslo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
