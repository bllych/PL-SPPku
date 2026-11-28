@props(['payment' => null])

<div class="bg-white rounded-xl border border-[#000000]/15 shadow-sm p-4 flex flex-col gap-3">
    <h3 class="font-bold text-base text-[#45C0F4]">Detail Pembayaran</h3>

    @if ($payment)
        @php
            $statusLabel = match ($payment->status) {
                'verified' => 'Terverifikasi',
                'rejected' => 'Ditolak',
                default => 'Menunggu Verifikasi',
            };

            $badgeClass = match ($payment->status) {
                'verified' => 'bg-green-50 text-green-600 border-green-400',
                'rejected' => 'bg-red-50 text-red-600 border-red-400',
                default => 'bg-amber-50 text-amber-600 border-amber-400',
            };

            $recommendedNotes = [
                'Pembayaran valid, terima kasih.',
                'Bukti transfer buram/tidak terbaca, silakan unggah ulang foto yang lebih jelas.',
                'Nominal transfer tidak sesuai dengan jumlah tagihan SPP.',
                'Rekening tujuan atau tanggal transfer tidak valid, silakan cek kembali bukti pembayaran Anda.',
                'Dana belum masuk ke mutasi rekening sekolah, silakan hubungi bagian Tata Usaha.',
            ];
        @endphp

        <div>
            <span class="inline-block rounded-md border px-2.5 py-1 text-[11px] font-semibold {{ $badgeClass }}">
                {{ $statusLabel }}
            </span>
        </div>

        <div class="space-y-1.5 text-xs border-b border-gray-100 pb-3">
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">Nama Siswa</span>
                <span class="font-semibold text-[#4E4E4E] text-right">{{ $payment->user->name ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">NISN</span>
                <span class="font-semibold text-[#4E4E4E] text-right">{{ $payment->user->student->nisn ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">Kelas</span>
                <span class="font-semibold text-[#4E4E4E] text-right">{{ $payment->user->student->class ?? '-' }}</span>
            </div>
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">Metode</span>
                <span class="font-semibold text-[#4E4E4E] text-right">{{ $payment->payment_method }}</span>
            </div>
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">Nominal</span>
                <span class="font-bold text-[#4E4E4E] text-right">
                    Rp. {{ number_format($payment->amount, 2, ',', '.') }}
                </span>
            </div>
            <div class="flex justify-between gap-2">
                <span class="text-gray-400">Tanggal Bayar</span>
                <span class="font-semibold text-[#4E4E4E] text-right">
                    {{ $payment->transaction_date->translatedFormat('d F Y, H:i') }}
                </span>
            </div>
        </div>

        <div class="space-y-1.5">
            <p class="text-xs font-semibold text-[#45C0F4]">Bukti Pembayaran</p>
            @if ($payment->proof_image)
                <img src="{{ asset('storage/' . $payment->proof_image) }}" alt="Bukti Pembayaran"
                    class="w-full h-36 object-cover rounded-lg border border-gray-200">
            @else
                <div
                    class="w-full h-32 rounded-lg border border-dashed border-gray-200 bg-slate-50 flex items-center justify-center text-[11px] text-gray-400">
                    Tidak ada bukti transfer
                </div>
            @endif
        </div>

        <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST" class="flex flex-col gap-2.5 pt-1"
            onsubmit="return confirm('Apakah Anda yakin ingin menyimpan keputusan verifikasi pembayaran ini?')">
            @csrf
            @method('PATCH')

            <div>
                <label for="adminNote" class="block text-[11px] font-medium text-gray-500 mb-1">
                    Catatan / Alasan Penolakan (wajib jika ditolak)
                </label>
                <textarea id="adminNote" name="note" rows="2" placeholder="Tulis catatan atau pilih rekomendasi di bawah..."
                    class="w-full rounded-lg border border-gray-200 p-2 text-xs text-[#4E4E4E] focus:border-[#45C0F4] focus:outline-none">{{ old('note', $payment->note) }}</textarea>

                {{-- Rekomendasi Komentar Cepat --}}
                <div class="mt-1.5">
                    <p class="text-[10px] font-medium text-gray-400 mb-1">Rekomendasi catatan cepat:</p>
                    <div class="flex flex-wrap gap-1">
                        @foreach ($recommendedNotes as $recNote)
                            <button type="button"
                                onclick="const box = document.getElementById('adminNote'); box.value = this.dataset.note; box.focus();"
                                data-note="{{ $recNote }}"
                                class="text-left rounded-md border border-sky-200 bg-sky-50/70 hover:bg-sky-100 px-2 py-1 text-[10px] leading-snug text-[#4E4E4E] transition-colors cursor-pointer">
                                {{ \Illuminate\Support\Str::limit($recNote, 45) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <button type="submit" name="status" value="verified"
                    class="w-full rounded-lg bg-[#28A745] hover:bg-green-600 py-2 text-xs font-semibold text-white transition-colors cursor-pointer">
                    Terima Pembayaran
                </button>
                <button type="submit" name="status" value="rejected"
                    onclick="if(!document.getElementById('adminNote').value.trim()){ alert('Harap isi atau pilih alasan penolakan terlebih dahulu!'); return false; }"
                    class="w-full rounded-lg bg-[#DC3545] hover:bg-red-600 py-2 text-xs font-semibold text-white transition-colors cursor-pointer">
                    Tolak Pembayaran
                </button>
            </div>
        </form>
    @else
        <p class="py-8 text-center text-xs text-gray-400">
            Pilih salah satu transaksi untuk melihat detail.
        </p>
    @endif
</div>