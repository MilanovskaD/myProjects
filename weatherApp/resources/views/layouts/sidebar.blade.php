<div class="space-y-4">
    {{-- Navigation Links --}}
    <nav>
        <ul class="space-y-2">
            <li class="flex justify-center relative group">
                <a href="{{ route('home') }}" class="p-3 rounded flex items-center">
                    <i class="fa-solid fa-house text-white"></i>
                </a>
                <span
                    class="absolute right-0 h-full w-0.5 bg-white scale-0 group-hover:scale-100 transition-transform"></span>
            </li>

            <li class="flex justify-center relative group">
<span class="p-3 rounded flex items-center" id="search">
  <a href="/?openSearch=true">
    <i class="fa-solid fa-magnifying-glass text-white"></i>
  </a>
</span>
                <span
                    class="absolute right-0 h-full w-0.5 bg-white scale-0 group-hover:scale-100 transition-transform"></span>
            </li>

            <li class="flex justify-center relative group">
                <a href="{{ route('map') }}" class="p-3 rounded flex items-center">
                    <i class="fa-solid fa-map-location-dot text-white"></i>
                </a>
                <span
                    class="absolute right-0 h-full w-0.5 bg-white scale-0 group-hover:scale-100 transition-transform"></span>
            </li>

            <li class="flex justify-center relative group">
                <a href="#" class="p-3 rounded flex items-center">
                    <i class="fa-solid fa-gear text-white"></i>
                </a>
                <span
                    class="absolute right-0 h-full w-0.5 bg-white scale-0 group-hover:scale-100 transition-transform"></span>
            </li>
        </ul>
    </nav>
</div>
<script>
    function toggleSidebar() {
        const sidePanel = document.getElementById('sidePanel');
        if (sidePanel.classList.contains('-translate-x-full')) {
            sidePanel.classList.remove('-translate-x-full'); // Slide in
        } else {
            sidePanel.classList.add('-translate-x-full'); // Slide out
        }
    }
</script>
