
@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="min-h-full bg-[#F3F5FF] px-5 py-2 md:px-1">

    {{-- Header Notifikasi --}}
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-xl font-bold text-[#45C0F4]">
                NOTIFIKASI
            </h2>

            <p class="text-base font-medium text-[#999999]">
                Informasi terbaru mengenai pembayaran SPP Anda
            </p>
        </div>

        <button
            type="button"
            id="markAllRead"
            class="flex items-center justify-center gap-2 self-start rounded-lg bg-white px-4 py-3 text-base font-bold text-[#45C0F4] shadow-md transition hover:bg-[#EAF8FF] sm:self-center"
        >
            <span class="text-lg font-bold">✓</span>
            Tandai sudah dibaca
        </button>
    </div>


    {{-- Daftar Notifikasi --}}
    <div class="rounded-lg bg-white px-5 py-3 shadow-md md:px-7">

        @foreach ($notifications as $notification)
            <div class="notification-item flex items-center gap-4 border-b border-[#E5E5E5] py-3 last:border-b-0 md:gap-6">

                {{-- Ikon Notifikasi --}}
                <div class="flex shrink-0 items-center justify-center">
                    <img
                        src="{{ asset('images/notification/' . $notification['icon'] . '.png') }}"
                        alt="{{ $notification['type'] }}"
                        class="h-12 w-12 object-contain md:h-14 md:w-14"
                    >
                </div>

                {{-- Isi Notifikasi --}}
                <div class="min-w-0 flex-1">
                    <h3 class="text-base font-semibold text-[#4E4E4E] md:text-lg">
                        {{ $notification['title'] }}
                    </h3>

                    <p class="text-sm font-medium leading-relaxed text-[#999999] md:text-base">
                        {{ $notification['message'] }}
                    </p>
                </div>

                {{-- Waktu dan Status --}}
                <div class="flex shrink-0 items-center gap-2">
                    <span class="text-xs font-medium text-[#B0B0B0] md:text-sm">
                        {{ $notification['time'] }}
                    </span>

                    @if (!$notification['read'])
                        <span class="unread-dot h-2 w-2 rounded-full bg-[#45C0F4]"></span>
                    @endif
                </div>

            </div>
        @endforeach

    </div>
</div>

{{-- Tandai semua notifikasi sebagai sudah dibaca --}}
<script>
    document.getElementById('markAllRead').addEventListener('click', function () {
        document.querySelectorAll('.unread-dot').forEach(function (dot) {
            dot.remove();
        });

        document.querySelectorAll('.notification-item').forEach(function (item) {
            item.classList.remove('bg-[#F8FCFF]');
        });
    });
</script>
@endsection
