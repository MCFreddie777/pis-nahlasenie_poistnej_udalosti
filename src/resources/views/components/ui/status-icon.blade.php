@props(['status','class'])


<div
    class="h-2 w-2 rounded-full inline-block mr-1
    {{ $status == 'rozpracovaná' ? 'bg-yellow-500' : '' }}
    {{ $status == 'čakajúca' ? 'bg-white border border-gray-600' : '' }}
    {{ $status == 'vybavená' ? 'bg-green-500' : '' }}
    {{ $class ?? '' }}
        "
    {{ $attributes }}
></div>

