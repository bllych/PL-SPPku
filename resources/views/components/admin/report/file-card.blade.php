@props([
    'name',
    'modified'
])

<div
    class="relative flex h-[164px] flex-col items-center justify-center
           rounded-lg border border-gray-200 bg-white
           shadow-sm transition hover:-translate-y-1 hover:shadow-md"
>

    {{-- More button --}}
    <button
        type="button"
        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700"
    >
        <svg
            class="h-5 w-5"
            viewBox="0 0 24 24"
            fill="currentColor"
        >
            <circle cx="12" cy="5" r="1.5"/>
            <circle cx="12" cy="12" r="1.5"/>
            <circle cx="12" cy="19" r="1.5"/>
        </svg>
    </button>

    {{-- File Icon --}}
    <img
        src="{{ asset('images/icons/excel.png') }}"
        alt="Excel"
        class="mb-2 h-[84px] w-[70px] object-contain"
    >

    {{-- File Name --}}
    <p class="max-w-[230px] truncate text-[16px] font-semibold text-gray-600">
        {{ $name }}
    </p>

    {{-- Modified Date --}}
    <p class="mt-1 text-[15px] text-gray-400">
        Modified {{ $modified }}
    </p>

</div>