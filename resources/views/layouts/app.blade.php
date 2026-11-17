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

<body class="flex h-screen flex-col bg-[#F7F6F2] text-slate-700"> 
    {{-- Header Start --}}
     @include('layouts.partials.header')
     {{-- Header End --}}
     
     {{-- Main Area --}} 
     <div class="mx-auto flex w-full flex-1 min-h-0">
        {{-- Sidebar Start --}} 
        @include('layouts.partials.sidebar')
        {{-- Sidebar End --}}
        
        {{-- Content Start --}} 
        <main class="flex-1 min-h-0 overflow-y-auto bg-[#F3F5FF] px-10 py-5"> @yield('content') </main>
        {{-- Content End --}}
    </div>

    {{-- Footer Start --}}
    @include('layouts.partials.footer')
    {{-- Footer End --}}
</body>

</html>