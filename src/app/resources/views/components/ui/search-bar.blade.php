@props(['class'])

<div
    class="searchbar bg-white rounded flex flex-row-reverse items-center px-1 h-10 w-48 rounded-full cursor-pointer
    @isset($class) {{$class}} @endisset"
>
    <i
        class="fas fa-search text-gray-500 px-1 pl-2"
    ></i>
    <input
        name="search"
        type="search"
        class="focus:outline-none w-full py-1 pl-2 rounded-full"
        placeholder="Vyhľadať..."
        {{ $attributes }}
    />
</div>
