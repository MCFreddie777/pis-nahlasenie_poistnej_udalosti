@extends('master')

@section('title','Moje zmluvy')

@php
    $options=[
        'data' =>  [
            'items'=> $contracts,
            'empty'=> 'Ľutujeme, nenašli sa žiadne zmluvy',
            'onclick'=> '/contracts/'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'zmluva',
                ],
                [
                    'name'=> 'platnosť od',
                ],
                [
                    'name'=> 'platnosť do',
                ],
                [
                    'name'=> '',
                ],
            ],
        ],
        'layout'=> [
            [
                'width'=>112,
                'width-sm'=>96,
                 'left'=> true
            ],
       ],
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Moje poistné zmluvy
            </h1>
            <div class="flex justify-end">
                <x-ui.search-bar
                    class="shadow-sm border mr-3"
                    :extendable="true"
                >
                </x-ui.search-bar>
                <x-ui.button
                    icon="fas fa-plus"
                    class="rounded-full"
                    text="Nová zmluva"
                    primary
                    type="link"
                    :href="url()->current().'/new'"
                >
                </x-ui.button>
            </div>
        </div>

        <x-ui.table
            :options="$options"
        >
            <!-- lib: konradkalemba/blade-components-scoped-slots -->
            @scopedslot('tableitem', ($item), ($options))

            <td
                class="{{ tableRowsClassObject($options,0)}}"
            >
                Zmluva č. {{  $item->id }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,1)}}"
            >
                {{ $item->valid_from }}
            </td>


            <td
                class="{{ tableRowsClassObject($options,2)}}"
            >
                {{ $item->valid_to }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,3)}}"
            >
                <x-ui.button
                    icon="fas fa-plus"
                    class="text-gray-400 hover:text-gray-600 mx-auto opacity-0 group-hover:opacity-100"
                    text="Vytvoriť udalosť"
                    type="link"
                    href="/events/new?id={{$item->id}}"
                >
                </x-ui.button>
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
