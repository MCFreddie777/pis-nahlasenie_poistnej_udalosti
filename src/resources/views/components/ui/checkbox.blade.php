@props(['name','text','reversed','value'])

<label
    @isset($name) for="{{$name}}" @endisset
    class="uppercase font-bold text-gray-500 text-sm checkbox-wrapper flex flex-row justify-center items-center mr-3
    @isset($reversed) reversed @endisset"
>
    {{ $text }}
    <input
        type="checkbox"
        @isset($name) name="{{$name}}" @endisset
        @isset($value) value="{{$value}}" @endisset
        {{ $attributes }}
    >
    <div class="checkmark flex flex-row justify-center items-center ml-1">
        <i
            class="fas fa-check text-white text-xs"
        ></i>
    </div>
</label>
