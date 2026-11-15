<header class="bg-[#45C0F4] shadow-md relative z-10">
    <div class="mx-auto flex items-center justify-between px-9 py-4">
        <a href="" class="flex items-center gap-3 w-59">
            <img src="{{ asset('images/logo/logo Sekolah Kristen Immanuel Payment.png') }}" alt="Logo"
                class="w-auto h-10">
        </a>
        <a href="" class="hidden gap-8 text-sm md:flex w-59 flex justify-center">
            <img src="{{ asset('images/logo/logo SPPku.png') }}" alt="Logo" class="w-auto h-10">
        </a>
        @auth
            <details class="relative flex w-59 justify-end">
                <summary class="list-none cursor-pointer rounded-lg focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                    aria-label="Buka menu akun">
                    <img src="{{ asset('images/icons/icon list.png') }}" alt="" class="h-10 w-auto">
                </summary>

                <div class="absolute right-0 top-full z-20 mt-2 min-w-52 rounded-xl bg-white p-3 shadow-lg">
                    <p class="mb-2 border-b border-gray-200 px-3 py-2 text-sm text-gray-600">
                        {{ auth()->user()->name }}
                    </p>

                    <form method="POST" action="{{ route('logout') }}" data-confirm-logout>
                        @csrf
                        <button type="submit"
                            class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </details>
        @endauth
    </div>
</header>
