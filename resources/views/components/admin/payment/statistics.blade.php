<div class="flex flex-row justify-between">
    @foreach ($stats as $stat)
        <div class="flex flex-row items-center gap-3 bg-white px-9 py-3 rounded-lg border-2 border-black/15">
            <img src="{{ asset('images/icons/' . $stat['icon']) }}" alt="{{ $stat['title'] }}" class="h-12 w-auto shrink-0">
            <div class="flex flex-col">
                <p class="text-sm font-medium text-[#999999]">{{ $stat['title'] }}</p>
                <p class="text-4xl font-bold text-[#4E4E4E]">{{ $stat['count'] }}</p>
            </div>
        </div>
    @endforeach
</div>