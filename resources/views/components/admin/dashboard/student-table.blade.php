<div class="
                    bg-white
                    rounded-[9px]
                    shadow-sm
                    overflow-hidden
                ">

    <div class="overflow-x-auto">

        <table class="w-full">


            {{-- =================================================
            HEADER TABLE
            ================================================== --}}
            <thead>

                <tr class="border-b border-gray-200">


                    {{-- NO --}}
                    <th class="
                                        w-[55px]
                                        px-3
                                        py-3
                                        text-center
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        No.
                    </th>



                    {{-- NAMA --}}
                    <th class="
                                        w-[270px]
                                        px-3
                                        py-3
                                        text-left
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        Nama
                    </th>



                    {{-- KELAS --}}
                    <th class="
                                        w-[140px]
                                        px-3
                                        py-3
                                        text-left
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        Kelas
                    </th>



                    {{-- TAGIHAN --}}
                    <th class="
                                        w-[220px]
                                        px-3
                                        py-3
                                        text-left
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        Tagihan
                    </th>



                    {{-- STATUS --}}
                    <th class="
                                        w-[180px]
                                        px-3
                                        py-3
                                        text-left
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        Status
                    </th>



                    {{-- AKSI --}}
                    <th class="
                                        w-[100px]
                                        px-3
                                        py-3
                                        text-left
                                        text-gray-700
                                        font-bold
                                        text-[18px]
                                    ">
                        Aksi
                    </th>

                </tr>

            </thead>



            {{-- =================================================
            BODY TABLE
            ================================================== --}}
            <tbody>

                @foreach ($students as $student)

                    <tr class="
                                                border-b
                                                border-gray-200
                                                hover:bg-gray-50
                                                transition
                                            ">


                        {{-- NO --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-center
                                                    text-gray-700
                                                    font-semibold
                                                    text-[18px]
                                                ">
                            {{ $student['id'] }}
                        </td>



                        {{-- NAMA --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-left
                                                    text-gray-700
                                                    font-semibold
                                                    text-[18px]
                                                    whitespace-nowrap
                                                ">
                            {{ $student['name'] }}
                        </td>



                        {{-- KELAS --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-left
                                                    text-gray-700
                                                    font-semibold
                                                    text-[18px]
                                                    whitespace-nowrap
                                                ">
                            12 TKJ 1
                        </td>



                        {{-- TAGIHAN --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-left
                                                    text-gray-700
                                                    font-semibold
                                                    text-[18px]
                                                    whitespace-nowrap
                                                ">
                            {{ $student['tuition'] }}
                        </td>



                        {{-- STATUS --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-left
                                                    font-semibold
                                                    text-[18px]
                                                    whitespace-nowrap
                                                ">

                            @if ($student['status'] === 'Lunas')

                                <span class="text-green-500">
                                    Lunas
                                </span>

                            @else

                                <span class="text-red-400">
                                    Belum Lunas
                                </span>

                            @endif

                        </td>



                        {{-- AKSI --}}
                        <td class="
                                                    px-3
                                                    py-2.5
                                                    text-left
                                                    font-semibold
                                                    text-[18px]
                                                    whitespace-nowrap
                                                ">

                            <a href="/students/{{ $student['id'] }}" class="
                                                        text-[#FFC857]
                                                        hover:underline
                                                    ">
                                Detail
                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>