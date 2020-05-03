@extends('master')

@section('title','Moje poistné udalosti')

@php
    $options=[
        'data' =>  [
            'items'=> $events,
            'empty'=> 'Nemáte žiadne poistné udalosti',
            'onclick'=> '/events/'
        ],
        'header'=> [
            'items'=> [
                [
                    'name'=> 'id',
                ],
                [
                    'name'=> 'poistná zmluva',
                ],
                [
                    'name'=> 'stav',
                ],
            ],
        ],
        'layout'=> [
            [
                'width'=>24,
            ],
            [
                'left'=>true,
            ],
       ],
    ];
@endphp

@section('content')
    <div class="bg-white rounded-lg">
        <div class="p-4 pl-6 flex justify-between">
            <h1 class="text-2xl">
                Moje poistné udalosti
            </h1>
        </div>

        <x-ui.table
            :options="$options"
        >
            <!-- lib: konradkalemba/blade-components-scoped-slots -->
            @scopedslot('tableitem', ($item), ($options))

            <td
                class="text-gray-600 {{ tableRowsClassObject($options,0)}}"
            >
                {{  $item->id }}
            </td>

            <td
                class="{{ tableRowsClassObject($options,1)}}"
            >
                Zmluva č.{{ $item->contract->id }}
            </td>


            <td
                class="{{ tableRowsClassObject($options,2)}}"
            >
                <x-ui.status-icon
                    class="absolute"
                    style="left:1em; top:40%;"
                    :status="$item->status"
                ></x-ui.status-icon>
                {{ $item->status }}
            </td>

            @endscopedslot
        </x-ui.table>
    </div>


@stop
