@php
    $navigation = [
        [
            'title' => '',
            'items' => [
                [
                    'path'=>'/moje-zmluvy',
                    'icon'=>'fas fa-file-contract',
                    'title'=> 'Moje zmluvy',
                ],
            ]
        ],
        [
            'title' => 'Placeholder',
            'items' => [
                [
                    'path'=> '/placeholder',
                    'icon'=> 'fas fa-file-contract',
                    'title'=> 'Placeholder'
                ],
            ]
        ],
        [
            'title'=> 'Účet',
            'items'=> [
                [
                    'path'=> '/change-password',
                    'icon'=> 'fas fa-lock',
                    'title'=> 'Zmena hesla'
                ],
                [
                    'path'=> '/logout',
                    'icon'=> 'fas fa-sign-out-alt',
                    'title'=> 'Odhlásiť sa'
                ]
            ]
        ]
    ];
@endphp

<div
    class="flex flex-col bg-gray-800 shadow-lg w-36 sm:w-48 md:w-56 xl:w-64"
    style="transition: width 0.1s ease-in-out;"
>

    <a href="/">
        <div
            class="logo flex justify-center bg-red-600 h-16"
        >
            <img
                {{--  TODO (fgic): logo--}}
                src="{{ asset('img/logo.svg') }}"
                alt=""
                class="h-full w-full py-4"
            >
        </div>
    </a>

    <nav class="flex flex-col flex-1">
        @foreach($navigation as $group)
            <x-navigation.item-group
                :group="$group"
            ></x-navigation.item-group>
        @endforeach

        <div class="flex flex-1 items-end">
            <a
                href="javascript:void(0)"
                class="text-gray-600 hover:text-gray-500 p-5 w-full text-center"
            >
                <i
                    class="fas fa-chevron-left"
                >
                </i>
            </a>
        </div>
    </nav>
</div>
