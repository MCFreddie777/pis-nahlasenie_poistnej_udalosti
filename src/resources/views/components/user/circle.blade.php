@props(['name'])

<div
    class="rounded-full text-white bg-red-600 w-10 h-10 flex justify-center items-center">
    {{ ucfirst($name[0]) }}
</div>
