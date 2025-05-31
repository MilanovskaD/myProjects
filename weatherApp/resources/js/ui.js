function initSearchUI() {
    const searchBtn = document.getElementById('search');
    const modal = document.getElementById('searchModal');
    const input = document.getElementById('searchInput');
    const resultsBox = document.getElementById('searchResults');
    const isHome = window.location.pathname === '/' || window.location.pathname.includes('home');

    if (!searchBtn || !modal) return;

    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isHome) {
            modal.classList.remove('hidden');
        } else {
            window.location.href = '/?openSearch=true';
        }
    });

    document.getElementById('closeModal')?.addEventListener('click', () => modal.classList.add('hidden'));

    if (new URLSearchParams(window.location.search).get('openSearch') === 'true') {
        modal.classList.remove('hidden');
        input?.focus();
        history.replaceState({}, document.title, window.location.pathname);
    }

    input.addEventListener('input', async (e) => {
        const query = e.target.value.trim();
        if (!query) return resultsBox.innerHTML = '';

        try {
            const res = await fetch(`https://api.openweathermap.org/geo/1.0/direct?q=${encodeURIComponent(query)}&limit=5&appid=232769df58efc9ad7a0df0af2f074825`);
            const cities = await res.json();
            resultsBox.innerHTML = cities.length
                ? cities.map(city => `
                    <div class="search-result p-2 hover:bg-gray-100 cursor-pointer rounded" data-lat="${city.lat}" data-lon="${city.lon}">
                        ${city.name}, ${city.state ? city.state + ', ' : ''}${city.country}
                    </div>`).join('')
                : '<div class="text-gray-500">No results found</div>';
        } catch (err) {
            console.error("Search error:", err);
            resultsBox.innerHTML = '<div class="text-red-500">Error fetching results</div>';
        }
    });

    resultsBox.addEventListener('click', async (e) => {
        const result = e.target.closest('.search-result');
        if (!result) return;

        const lat = result.dataset.lat;
        const lon = result.dataset.lon;
        const cityName = result.textContent.trim();

        const offset = await getTimezoneForCoordinates(lat, lon);

        localStorage.setItem('selectedCity', cityName);
        localStorage.setItem('selectedCoords', JSON.stringify({ lat, lon }));
        localStorage.setItem('selectedTimezone', offset);

        getWeatherData(parseFloat(lat), parseFloat(lon));
        document.getElementById('searchInput').value = cityName;
        modal.classList.add('hidden');
        updateTime(offset);
        setTimeLabel('city', cityName);
    });

    document.getElementById('useMyLocation')?.addEventListener('click', () => {
        localStorage.removeItem('selectedCity');
        localStorage.removeItem('selectedCoords');
        localStorage.removeItem('selectedTimezone');
        getLocation();
        setTimeLabel('local');
    });

}

window.initSearchUI = initSearchUI;
