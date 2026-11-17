@props(['payments'])

<div class="bg-white rounded-lg border-2 border-black/15 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-[#555555] text-sm font-bold">
                    <th class="py-3 px-4 w-12 text-center">No.</th>
                    <th class="py-3 px-4">Siswa</th>
                    <th class="py-3 px-4">Kelas</th>
                    <th class="py-3 px-4">Nominal</th>
                    <th class="py-3 px-4">Metode</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-xs">
                @foreach ($payments as $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-2.5 px-4 text-center font-medium text-[#4E4E4E]">{{ $item['no'] }}</td>
                        <td class="py-2 px-4">
                            <div class="font-semibold text-sm leading-tight text-[#4E4E4E]">{{ $item['nama'] }}
                            </div>
                            <div class="text-[10px] text-gray-400 font-medium tracking-wide">{{ $item['nisn'] }}
                            </div>
                        </td>
                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                            {{ $item['kelas'] }}
                        </td>
                        <td class="py-2.5 px-4 font-medium text-sm text-[#4E4E4E] whitespace-nowrap">
                            {{ $item['nominal'] }}
                        </td>
                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                            {{ $item['metode'] }}
                        </td>
                        <td class="py-2.5 px-4 whitespace-nowrap">
                            <div class="font-medium text-[#4E4E4E]">{{ $item['tanggal'] }}</div>
                            <div class="text-[10px] text-gray-400 font-medium">{{ $item['jam'] }}</div>
                        </td>
                        <td class="py-2.5 px-2 text-center whitespace-nowrap">
                                <x-admin.status-badge :status="$item['status']" />
                        </td>
                        <td class="py-2.5 px-4 text-center whitespace-nowrap">
                            @if ($item['status'] === 'Menunggu' || $item['status'] === 'Ditolak')
                                <a href="#"
                                    class="inline-block py-2 text-xs font-medium text-white bg-[#45C0F4] hover:bg-sky-500 rounded-lg shadow-sm transition-colors w-19">
                                    Verifikasi
                                </a>
                            @else
                                <a href="#"
                                    class="inline-block py-2 text-xs font-medium text-[#45C0F4] bg-white border border-[#45C0F4] hover:bg-sky-50 rounded-lg transition-colors w-19">
                                    Detail
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>