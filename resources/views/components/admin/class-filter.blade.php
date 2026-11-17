<button
    {{ $attributes->merge([
        'class' => '
            w-[130px]
            h-[45px]
            bg-white
            rounded-full
            shadow-sm
            text-gray-600
            font-semibold
            text-[18px]
        '
    ]) }}
>
    {{ $label }}
</button>