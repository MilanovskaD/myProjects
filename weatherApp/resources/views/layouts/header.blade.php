<div class="flex items-center justify-between">
    {{-- Hamburger Menu --}}
    <div class="flex-shrink-0">
        <a href="#" class="p-3 bg-white/10 dark:bg-black/20 rounded-lg shadow-lg hover:shadow-xl transition-shadow"
           onclick="toggleSidebar()">
            <i class="fa-solid fa-bars text-black dark:text-white"></i>
        </a>
    </div>

    {{-- Three Divs --}}
    <div class="flex flex-1 justify-around ml-4 gap-4">
        <div class="w-full md:w-1/4 bg-white/10 dark:bg-black/20 rounded-lg p-2.5 text-center backdrop-blur-sm text-black dark:text-white">
            Despina's Weather Forecast Website
        </div>

        <div class="w-full md:w-1/4 bg-white/10 dark:bg-black/20 rounded-lg p-2.5 text-center backdrop-blur-sm text-black dark:text-white">
            <span id="@yield('locationId', 'location')">Fetching location...</span>
        </div>

        <div class="w-full md:w-1/4 bg-white/10 dark:bg-black/20 rounded-lg p-2.5 text-center backdrop-blur-sm text-black dark:text-white">
            <span id="@yield('currentTimeId', 'currentTime')">Loading...</span>
            <small id="timeLabel" class="dark:text-white"></small>
        </div>
    </div>
</div>
