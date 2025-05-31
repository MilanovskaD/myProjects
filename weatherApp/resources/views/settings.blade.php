@extends('layouts.app')

@section('title', 'Weather Forecast')

@section('locationId', 'locationSettings')

@section('currentTimeId', 'currentTimeSettings')

@section('main')

    <div class="max-w-md mx-auto mt-10 p-6 bg-white/10 backdrop-blur-sm rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold mb-6">Settings</h1>

        <!-- Temperature Unit Toggle -->
        <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm p-4 rounded-xl">
            <span class="text-lg font-semibold">°C</span>

            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer" id="unitToggle">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full
                        after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-blue-500
                        after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
            </label>

            <span class="text-lg font-semibold">°F</span>
        </div>

        <h2 class="text-xl font-bold mb-4 text-white">🌧 Rain Alert Subscription</h2>

        @if (session('success'))
            <div class="text-green-400 mb-4">{{ session('success') }}</div>
        @endif

        <form method="POST" action="
        {{ route('rain-alert.subscribe') }}
        ">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm text-white">Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full p-2 rounded text-black" placeholder="you@example.com">
            </div>

            <div class="mb-4">
                <label for="city" class="block text-sm text-white">City</label>
                <input type="text" name="city" id="city" required
                       class="w-full p-2 rounded text-black" placeholder="e.g. Skopje">
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition">
                Subscribe
            </button>
        </form>
    </div>


@endsection

