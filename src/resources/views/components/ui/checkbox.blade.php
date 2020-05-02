@props(['name','text','reversed'])

<label
    :for="$name"
    class="uppercase font-bold text-gray-500 text-sm checkbox-wrapper flex flex-row justify-center items-center mr-3
    @isset($reversed) reversed @endisset"
>
    {{ $text }}
    <input
        type="checkbox"
        :name="$name"
    >
    <div class="checkmark flex flex-row justify-center items-center ml-1">
        <i
            class="fas fa-check text-white text-xs"
        ></i>
    </div>
</label>
