@extends('layouts.app')

@section('title', 'Weather Forecast')

@section('locationId', 'location')

@section('currentTimeId', 'currentTime')

@section('main')
    <!-- Video background container -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden">
        <video id="weather-video-bg" autoplay loop muted playsinline class="w-full h-full object-cover blur-sm opacity-80">
            <!-- Videos will be rendered her -->
        </video>
    </div>

    <div class="text-center mt-10 relative">
        <!-- Current weather -->
        <div class="flex flex-col items-center gap-2 mb-8">
            <div id="current-day" class="text-lg font-semibold"></div>
            <div class="flex items-center justify-center">
                <div id="temperature" class="text-4xl font-bold"></div>
{{--                <img src="/svg/wi-celsius.svg" alt="°C" class="w-10 h-10">--}}
            </div>
            <img id="current-weather-icon" src="" alt="icon" class="w-16 h-16">
            <div id="location" class="text-xl"></div>
        </div>

        <!-- Weather cards -->
        <div id="weather-cards" class="flex gap-4 overflow-x-auto p-4 justify-center"></div>
    </div>


    <!-- Search Modal -->
    <div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-[28rem] max-h-[80vh] overflow-y-auto relative shadow-xl">
            <!-- Close Button -->
            <button id="closeModal" class="absolute top-2 right-3 text-gray-500 hover:text-black text-lg font-bold">&times;</button>

            <!-- Search Input -->
            <h2 class="text-xl font-semibold mb-4 text-center">Search City</h2>
            <input
                type="text"
                id="searchInput"
                placeholder="Enter city name..."
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
            />
            <!-- Search Results -->
            <div id="searchResults" class="space-y-2 max-h-60 overflow-y-auto">
                <!--Results will appear here -->
            </div>
        </div>
    </div>

@endsection

{{--https://api.openweathermap.org/data/2.5/forecast?lat=41.34&lon=10.99&appid=232769df58efc9ad7a0df0af2f074825   full open weather api --}}
