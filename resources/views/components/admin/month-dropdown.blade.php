@props([
    'label' => 'September 2026',
    'months' => [
        'sep-2026' => 'September 2026',
        'aug-2026' => 'Agustus 2026',
        'jul-2026' => 'Juli 2026',
        'jun-2026' => 'Juni 2026',
        'may-2026' => 'Mei 2026',
        'apr-2026' => 'April 2026',
        'mar-2026' => 'Maret 2026',
        'feb-2026' => 'Februari 2026',
        'jan-2026' => 'Januari 2026',
    ]
])

<details class="relative group">
    <summary
        class="flex items-center justify-between bg-white border-2 border-[#000000]/15 text-[#999999] font-medium pl-4 pr-3 py-2 rounded-lg text-md cursor-pointer list-none select-none">

        <span class="whitespace-nowrap mr-8">
            {{ $label }}
        </span>

        <svg
            class="w-6 h-6 text-[#999999] group-open:rotate-180 transition-transform shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7">
            </path>

        </svg>
    </summary>

    <div
        class="absolute left-0 mt-1 w-full max-h-40 overflow-y-auto bg-white border-2 border-[#000000]/15 rounded-lg shadow-md py-1 z-50 text-md">

        @foreach ($months as $val => $month)
            <a href="#"
                class="block px-4 py-1.5 text-[#4E4E4E] hover:bg-sky-50 hover:text-[#45C0F4]">
                {{ $month }}
            </a>
        @endforeach

    </div>
</details>