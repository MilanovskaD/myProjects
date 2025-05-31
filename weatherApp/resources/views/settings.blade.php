@extends('layouts.app')

@section('title', 'Weather Forecast')

@section('locationId', 'locationSettings')
@section('currentTimeId', 'currentTimeSettings')

@section('main')
    <div class="max-w-xl mx-auto mt-16 p-6 bg-white/10 backdrop-blur-xl rounded-2xl shadow-xl text-white space-y-10 transition-all">

        <h1 class="text-3xl font-bold text-center">⚙️ Settings</h1>

        <!-- Temperature Unit Toggle -->
        <div class="bg-white/10 rounded-xl p-5 shadow-inner space-y-4">
            <h2 class="text-xl font-semibold">🌡 Temperature Unit</h2>
            <div class="flex items-center justify-between">
                <span class="text-lg font-medium">°C</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" id="unitToggle">
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full
                    after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-blue-500
                    after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
                <span class="text-lg font-medium">°F</span>
            </div>
        </div>

        <!-- Rain Alerts Section -->
        <div class="bg-white/10 rounded-xl p-5 shadow-inner space-y-5">
            <h2 class="text-xl font-semibold">📬 Rain Alert Subscription</h2>

            @if (session('success'))
                <div class="p-3 bg-green-500/10 text-green-300 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('rain-alert.subscribe') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full p-3 rounded-lg bg-white/90 text-black focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <div>
                    <label for="city" class="block text-sm mb-1">City</label>
                    <input type="text" name="city" id="city" required
                           class="w-full p-3 rounded-lg bg-white/90 text-black focus:outline-none focus:ring focus:ring-blue-300">
                </div>
                <button type="submit"
                        class="w-full bg-white/20 hover:bg-white/30 text-white font-semibold py-2 px-4 rounded-xl transition duration-300 shadow">
                    ✅ Subscribe to Alerts
                </button>
            </form>
        </div>
    </div>
@endsection
