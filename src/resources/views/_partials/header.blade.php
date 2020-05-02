<div
    class="flex h-16 justify-end shadow border-b border-gray-400 items-center "
    style="box-sizing: content-box;"
>
    <a
        href="/change-password"
        class="flex px-5 items-center hover:cursor-pointer hover:bg-gray-100"
    >
        <x-user.circle
            :name="Auth::user()->email"
        ></x-user.circle>
        <span class="pl-3 text-gray-900">
            {{  Auth::user()->email }}
        </span>
    </a>
</div>
