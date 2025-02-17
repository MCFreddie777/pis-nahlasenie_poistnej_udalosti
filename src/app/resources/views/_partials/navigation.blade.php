@php
    $navigation = [
        [
            'title' => '',
            'gates' => ['user','admin'],
            'items' => [
                [
                    'path'=>'/contracts',
                    'icon'=>'fas fa-file-contract',
                    'title'=> 'Moje zmluvy',
                ],
                 [
                    'path'=>'/events',
                    'icon'=>'fas fa-car-crash',
                    'title'=> 'Moje poistné udalosti',
                ],
            ]
        ],
        [
            'title' => 'Zamestnanec',
            'gates' => ['employee','admin'],
            'items' => [
                [
                    'path'=> '/review-events',
                    'icon'=> 'fas fa-file-signature',
                    'title'=> 'Poistné udalosti'
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
            class="logo flex justify-center items-center bg-red-600 h-16"
        >
            <h1
                class="text-2xl text-white inline-block"
            >
                Poisťovňa s.r.o.
            </h1>
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
