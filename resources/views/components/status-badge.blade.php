@php
    $statusClass = match (strtolower($status)) {
        'lunas' => 'bg-[#bdfcae] text-[#3a9b2c]',
        'belum lunas' => 'bg-[#ffe8a8] text-[#e89b00]',
        'terlambat' => 'bg-[#ffd1d1] text-[#d93636]',
        default => 'bg-gray-100 text-gray-500',
    };
@endphp

<span
    {{ $attributes->merge([
        'class' => "flex h-[32px] w-[140px] items-center justify-center rounded-lg text-[16px] font-semibold {$statusClass}"
    ]) }}
>
    {{ $status }}
</span>