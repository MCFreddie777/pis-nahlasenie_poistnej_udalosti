@props(['name'])

<div
    class="rounded-full text-white bg-red-600 w-10 h-10 flex justify-center items-center">

    @php
        // breaks the name word by word and gets capitalized initials
        $initials = array_map(function($item) {
            return ucfirst(mb_substr($item,0,1));
        },preg_split("/\s+/", $name))
    @endphp
    {{ implode('',$initials) }}
</div>
