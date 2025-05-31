<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Weather')</title>

    {{--   Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    {{--   Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/map.js' ])

    {{--   Font awesome--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3c18f363e4.js" crossorigin="anonymous"></script>

    {{--  icons css--}}
    <link rel="stylesheet" href="{{ asset('weather-icons.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">

    {{--    Leaflet js--}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    {{--jquery--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{--    Particles js--}}
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

</head>
<body style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3));"
      class="bg-cover bg-center min-h-screen relative overflow-hidden">


{{-- Header --}}
<header class="w-full p-4 bg-white/10 backdrop-blur-md border-b border-white/10 shadow-lg">
    @include('layouts.header')
</header>

{{-- Main content with sidebar --}}
<div class="flex flex-1 h-screen">
    {{-- Sidebar --}}
    <aside
        class="w-20 max-h-[calc(100vh-7rem)] overflow-y-auto bg-white/10 backdrop-blur-md border border-white/20 shadow-lg text-white p-4 ms-3 my-6
        rounded-2xl transform transition-transform duration-300 ease-in-out -translate-x-full"
        id="sidePanel">
        @include('layouts.sidebar')
    </aside>

    {{-- Main content area --}}
    <main class="flex-1 p-10">
        @yield('main')
    </main>
</div>

{{-- Footer --}}
<footer class="">
    <div class="">
        @include('layouts.footer')
    </div>
</footer>
</body>
</html>
