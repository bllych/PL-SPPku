@props(['schoolYears', 'selectedSchoolYear', 'selectedStatus', 'search'])

<form method="GET" action="{{ url()->current() }}" class="mb-5 flex flex-col gap-3 md:flex-row md:items-center">
    <label for="payment-search" class="sr-only">Cari bulan pembayaran</label>
    <input
        id="payment-search"
        type="search"
        name="q"
        value="{{ $search }}"
        placeholder="Cari bulan pembayaran..."
        class="h-[42px] w-full rounded-full border border-gray-200 bg-white px-4 text-sm text-gray-600 outline-none transition focus:border-[#38b8ed] focus:ring-2 focus:ring-[#38b8ed]/20 md:flex-1"
    >

    <label for="payment-status" class="sr-only">Filter status tagihan</label>
    <select
        id="payment-status"
        name="status"
        class="h-[42px] w-full rounded-lg border border-gray-200 bg-white px-4 text-sm text-gray-500 outline-none focus:border-[#38b8ed] focus:ring-2 focus:ring-[#38b8ed]/20 md:w-[180px]"
    >
        <option value="" @selected($selectedStatus === '')>Semua Status Tagihan</option>
        <option value="paid" @selected($selectedStatus === 'paid')>Lunas</option>
        <option value="unpaid" @selected($selectedStatus === 'unpaid')>Belum Lunas</option>
        <option value="overdue" @selected($selectedStatus === 'overdue')>Terlambat</option>
    </select>

    <label for="payment-school-year" class="sr-only">Filter tahun ajaran</label>
    <select
        id="payment-school-year"
        name="school_year"
        class="h-[42px] w-full rounded-lg border border-gray-200 bg-white px-4 text-sm text-gray-500 outline-none focus:border-[#38b8ed] focus:ring-2 focus:ring-[#38b8ed]/20 md:w-[150px]"
    >
        @foreach ($schoolYears as $schoolYear)
            <option value="{{ $schoolYear }}" @selected($selectedSchoolYear === $schoolYear)>
                {{ $schoolYear }}
            </option>
        @endforeach
    </select>

    <button
        type="submit"
        class="h-[42px] rounded-lg bg-[#38b8ed] px-5 text-sm font-semibold text-white transition hover:bg-sky-500"
    >
        Terapkan
    </button>
</form>
