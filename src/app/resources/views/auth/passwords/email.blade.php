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

            <div class="w-96 bg-white rounded-lg shadow-xl p-8">

                <h1 class="text-gray-800 text-3xl font-bold pt-3 text-center">Zabudnuté heslo</h1>
                <p class="text-center text-gray-700 mt-3">Zadajte adresu Vášho účtu, na ktorú vam bude odoslaný resetovací link</p>


                <form method="POST" action="/password/email" class="relative mt-10" >
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

                    @error('email')
                    <p
                        class="text-red-500 absolute text-sm"
                        style="top:-1.5rem"
                    >
                        @if(isset($message))
                            <span>
                                {{ $message }}
                            </span>
                        @else
                            <span>
                                 Niekde nastala chyba. Skúste <!--
                            --><a
                                    href="javascript:location.reload()"
                                    class="text-blue-500 underline"
                                >obnoviť stránku<!--
                            --></a>.
                            </span>
                        @endif

                    </p>
                    @enderror

                    <div
                        class="relative border-2 rounded border-white"
                    >
                        <x-ui.input
                            type="email"
                            name="email"
                            required="true"
                            autofocus="true"
                            placeholder="vasa@adresa.sk"
                            w-full
                        >
                        </x-ui.input>
                    </div>

                    <div class="pt-8 text-center">
                        <button
                            type="submit"
                            class="bg-red-600 py-2 px-6 text-center rounded-full text-white mx-auto hover:bg-red-500 focus:outline-none"
                        >
                            Odoslať resetovací email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
