<div class="flex items-center justify-between">
    {{--  Hamburger Menu --}}
    <div class="flex-shrink-0">
        <a href="#" class="p-3 bg-white/10 rounded-lg shadow-lg hover:shadow-xl transition-shadow"
           onclick="toggleSidebar()">
            <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
        </a>
    </div>
    {{--  Three Divs --}}
    <div class="flex flex-1 justify-around ml-4 gap-4">
        <div class="w-full md:w-1/4 bg-white/10 rounded-lg p-2.5 text-center backdrop-blur-sm">
            Despina's Weather Forecast Website
        </div>
        <div class="w-full md:w-1/4 bg-white/10 rounded-lg p-2.5 text-center backdrop-blur-sm">
            <span id="@yield('locationId', 'location')">Fetching location...</span>
        </div>
        <div class="w-full md:w-1/4 bg-white/10 rounded-lg p-2.5 text-center backdrop-blur-sm">
            <span id="@yield('currentTimeId', 'currentTime')">Loading...</span>
        </div>
    </div>
</div>
