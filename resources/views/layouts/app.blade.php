<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-[#F7F6F2] text-slate-700">
    {{-- Header Start --}}
    @include('layouts.partials.header')
    {{-- Header End --}}

    <div class="mx-auto flex w-full flex-1">
        {{-- Sidebar Start --}}
        @include('layouts.partials.sidebar')
        {{-- Sidebar End --}}

        {{-- Content Start --}}
        <main class="flex-1 px-10 py-5 bg-[#F3F5FF] overflow-hidden">
            @yield('content')
        </main>
        {{-- Content End --}}
    </div>

    {{-- Footer Start --}}
    @include('layouts.partials.footer')
    {{-- Footer End --}}
</body>

</html>