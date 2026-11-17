@props(['status'])

@if ($status === 'Terverifikasi')
    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold text-green-700 bg-green-50 border border-green-200">
        Terverifikasi
    </span>
@elseif ($status === 'Menunggu')
    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold text-yellow-700 bg-yellow-50 border border-yellow-200">
        Menunggu
    </span>
@else
    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold text-red-700 bg-red-50 border border-red-200">
        Ditolak
    </span>
@endif