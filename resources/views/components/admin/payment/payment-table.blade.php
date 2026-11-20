<tbody class="divide-y divide-gray-100 text-xs">
                @forelse ($payments as $item)
                    @php
                        $statusLabel = match($item->status) {
                            'verified' => 'Terverifikasi',
                            'rejected' => 'Ditolak',
                            default    => 'Menunggu',
                        };
                    @endphp

                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-2.5 px-4 text-center font-medium text-[#4E4E4E]">
                            {{ $payments->firstItem() + $loop->index }}
                        </td>
                        <td class="py-2 px-4">
                            <div class="font-semibold text-sm leading-tight text-[#4E4E4E]">
                                {{ $item->user->name ?? '-' }}
                            </div>
                            <div class="text-[10px] text-gray-400 font-medium tracking-wide">
                                {{ $item->bill->student->nisn ?? '-' }}
                            </div>
                        </td>
                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                            {{ $item->bill->student->class ?? '-' }}
                        </td>
                        <td class="py-2.5 px-4 font-medium text-sm text-[#4E4E4E] whitespace-nowrap">
                            Rp. {{ number_format($item->amount, 2, ',', '.') }}
                        </td>
                        <td class="py-2.5 px-4 font-medium text-[#4E4E4E] whitespace-nowrap">
                            {{ $item->payment_method }}
                        </td>
                        <td class="py-2.5 px-4 whitespace-nowrap">
                            <div class="font-medium text-[#4E4E4E]">
                                {{ $item->transaction_date->translatedFormat('d M Y') }}
                            </div>
                            <div class="text-[10px] text-gray-400 font-medium">
                                {{ $item->transaction_date->format('H:i') }} WIB
                            </div>
                        </td>
                        <td class="py-2.5 px-2 text-center whitespace-nowrap">
                            <x-admin.status-badge :status="$statusLabel" />
                        </td>
                        <td class="py-2.5 px-4 text-center whitespace-nowrap">
                            @if ($statusLabel === 'Menunggu' || $statusLabel === 'Ditolak')
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
                @empty
                    <tr>
                        <td colspan="8" class="py-6 text-center text-gray-400">
                            Belum ada data transaksi pembayaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>