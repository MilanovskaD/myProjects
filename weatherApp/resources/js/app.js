import './bootstrap';

// OpenWeatherMap API key
const apiKey = '232769df58efc9ad7a0df0af2f074825';

let useLocalTime = true;

//Get local time and update every second
function updateTime() {
    const now = new Date();
    const options = {
        hour12: true,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };

    if (!useLocalTime) {
        options.timeZone = 'America/Los_Angeles';
    }

    document.getElementById('currentTime').textContent =
        now.toLocaleTimeString(undefined, options);
}

navigator.geolocation.getCurrentPosition(
    () => {
        useLocalTime = true;
        updateTime();
    },
    () => {
        useLocalTime = false;
        updateTime();
    }
);

setInterval(updateTime, 1000);

document.getElementById('currentTime').textContent = "Loading time...";

//Main function to get weather data
async function getWeatherData(lat, lon) {
    try {
        // Fetch both current weather and forecast
        const [cityName, weatherData] = await Promise.all([
            getCityName(lat, lon),
            fetchWeatherData(lat, lon)
        ]);

        // Update UI
        document.getElementById('location').textContent = cityName || "Unknown location";
        updateWeatherUI(weatherData);

    } catch (error) {
        console.error('Error getting weather data:', error);
        document.getElementById('location').textContent = "Los Angeles";
        document.getElementById('temperature').textContent = 'Failed to load data';
    }
}

// Fetch all weather data from API
async function fetchWeatherData(lat, lon) {
    const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;
    const response = await fetch(apiUrl);
    return await response.json();
}

// Convert coordinates to city name
async function getCityName(latitude, longitude) {
    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
    const data = await response.json();
    return data.address.city || data.address.town || data.address.village || data.address.county;
}


// Process 3-hour forecasts into daily forecasts
function processDailyForecasts(forecastList) {
    const dailyForecasts = [];
    const daysProcessed = new Set();
    const today = new Date().getDay();

    forecastList.forEach(item => {
        const date = new Date(item.dt * 1000);
        const dayIndex = date.getDay(); // 0-6
        const dayName = date.toLocaleDateString('en-US', { weekday: 'short' });

        if (dayIndex !== today && !daysProcessed.has(dayName)) {
            daysProcessed.add(dayName);
            dailyForecasts.push({
                day: dayName,
                temp: Math.round(item.main.temp),
                humidity: item.main.humidity,
                icon: item.weather[0].icon
            });
        }
    });

    return dailyForecasts.slice(0, 7);
}

// Render weather cards
function renderWeatherCards(forecasts) {
    const container = document.getElementById('weather-cards');
    container.innerHTML = '';

    forecasts.forEach(day => {
        const card = document.createElement('div');
        card.className = 'min-w-[150px] bg-white/10 rounded-lg p-4 text-center backdrop-blur-sm hover:bg-white/20 transition-all';

        card.innerHTML = `
            <div class="text-lg font-semibold">${day.day}</div>
            <img src="/svg/wi-${getWeatherIcon(day.icon)}.svg" alt="${day.condition}" class="w-12 h-12 mx-auto my-2" />
            <div class="text-xl font-bold">${day.temp}°C</div>
            <div class="text-sm">${day.humidity}%</div>
        `;
        container.appendChild(card);
    });
}

// Weather icon mapping
function getWeatherIcon(iconCode) {
    const iconMap = {
        // Day icons
        '01d': 'day-sunny',
        '02d': 'day-cloudy',
        '03d': 'cloud',
        '04d': 'cloudy',
        '09d': 'rain',
        '10d': 'day-rain',
        '11d': 'thunderstorm',
        '13d': 'snow',
        '50d': 'fog',

        // Night icons
        '01n': 'night-clear',
        '02n': 'night-alt-cloudy',
        '03n': 'cloud',
        '04n': 'cloudy',
        '09n': 'rain',
        '10n': 'night-alt-rain',
        '11n': 'thunderstorm',
        '13n': 'snow',
        '50n': 'fog'
    };
    return iconMap[iconCode] || 'day-sunny'; // Default icon
}

//Get weather based videos
function getWeatherVideo(weatherCondition, isNight = false) {
    const videoMap = {
        'clear': {
            day: '/videos/sunny.mp4',
            night: '/videos/night-clear.mp4'
        },
        'clouds': {
            day: '/videos/clouds.mp4',
            night: '/videos/night-clouds.mp4'
        },
        'rain': {
            day: '/videos/rain.mp4',
            night: '/videos/night-rain.mp4'
        },
        'drizzle': {
            day: '/videos/rain-light.mp4',
            night: '/videos/night-rain-light.mp4'
        },
        'thunderstorm': {
            day: '/videos/thunderstorm.mp4',
            night: '/videos/night-thunderstorm.mp4'
        },
        'snow': {
            day: '/videos/snow.mp4',
            night: '/videos/night-snow.mp4'
        },
        'fog': {
            day: '/videos/fog.mp4',
            night: '/videos/night-fog.mp4'
        }
    };

    // Normalize condition name
    const normalizedCondition = weatherCondition.toLowerCase();

    // Find the best matching condition
    const matchedCondition = Object.keys(videoMap).find(key =>
        normalizedCondition.includes(key)
    ) || 'clear'; // Default to clear weather

    // Return appropriate video based on time
    return isNight ?
        (videoMap[matchedCondition]?.night || '/videos/night-clear.mp4') :
        (videoMap[matchedCondition]?.day || '/videos/sunny.mp4');
}

// Get user location
function getLocation() {
    // Check for saved coordinates first
    const savedCoords = localStorage.getItem('selectedCoords');
    if (savedCoords) {
        try {
            const { lat, lon } = JSON.parse(savedCoords);
            getWeatherData(lat, lon);
            return;
        } catch (e) {
            console.error("Error parsing saved coordinates", e);
        }
    }

    // Fall back to geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const { latitude, longitude } = position.coords;
                getWeatherData(latitude, longitude);
            },
            error => {
                console.error("Error getting location:", error.message);
                // Default to Los Angeles
                getWeatherData(34.0522, -118.2437);
            }
        );
    } else {
        console.error("Geolocation not supported");
        // Default to Los Angeles
        getWeatherData(34.0522, -118.2437);
    }
}

function getCurrentDay() {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const now = new Date();
    return days[now.getDay()];
}

getLocation();

// Check if it's nighttime
// Check if it's nighttime using UTC offset
function isNightTimeByOffset(timezoneOffsetInSeconds) {
    try {
        const nowUTC = new Date();
        const localTime = new Date(nowUTC.getTime() + timezoneOffsetInSeconds * 1000);
        const hour = localTime.getUTCHours(); // Because it's adjusted already

        console.log(`Local hour by offset: ${hour}`);
        return hour >= 18 || hour < 6; // Night between 6 PM and 6 AM
    } catch (e) {
        console.error("Error in isNightTimeByOffset:", e);
        // Fallback to device time
        const hour = new Date().getHours();
        return hour >= 18 || hour < 6;
    }
}

// Update all weather UI elements
function updateWeatherUI(weatherData) {
    if (!weatherData.list || weatherData.list.length === 0) {
        throw new Error('No weather data available');
    }

    const currentWeather = weatherData.list[0];
    const currentTemp = Math.round(currentWeather.main.temp);
    const weatherCondition = currentWeather.weather[0].main;
    const currentIconCode = currentWeather.weather[0].icon;
    const cityName = weatherData.city.name;
    const timezoneOffset = weatherData.city.timezone;

    const isNight = isNightTimeByOffset(timezoneOffset);
    console.log("Is night time?", isNight);

    const tempEl = document.getElementById('temperature');
    const locationEl = document.getElementById('location');
    const iconEl = document.getElementById('current-weather-icon');
    const videoBg = document.getElementById('weather-video-bg');

    if (!tempEl || !locationEl || !videoBg || !iconEl) {
        throw new Error('Missing one or more required DOM elements');
    }

    tempEl.textContent = `${currentTemp}°C`;
    locationEl.textContent = cityName;
    document.getElementById('current-day').textContent = getCurrentDay();

    // Set weather icon
    iconEl.src = `/svg/wi-${getWeatherIcon(currentIconCode)}.svg`;
    iconEl.alt = weatherCondition;

    // Set background video
    const videoSrc = getWeatherVideo(weatherCondition, isNight);
    if (videoBg.getAttribute('src') !== videoSrc) {
        videoBg.setAttribute('src', videoSrc);
        videoBg.load();
    }

    // Render forecast cards
    const forecasts = processDailyForecasts(weatherData.list);
    renderWeatherCards(forecasts);
}



document.addEventListener('DOMContentLoaded', () => {
    const searchBtn = document.getElementById('search');
    const modal = document.getElementById('searchModal');
    const isHome = window.location.pathname === '/' || window.location.pathname.includes('home');

    if (!searchBtn || !modal) return;

    if (isHome) {
        searchBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // modal.addEventListener('click', (e) => {
        //     if (e.target === modal) {
        //         modal.classList.add('hidden');
        //     }
        // });

        // Auto-open modal if URL contains ?openSearch=true
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('openSearch') === 'true') {
            modal.classList.remove('hidden');
            document.getElementById('searchInput')?.focus();

            // Clean URL
            const newUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    } else {
        searchBtn.addEventListener('click', () => {
            window.location.href = '/?openSearch=true';
        });
    }
    //Prevent loading/re-opening when you are already on home page
    searchBtn.addEventListener('click', (e) => {
        if (isHome) {
            e.preventDefault(); // prevent <a> navigation
            modal.classList.remove('hidden');
        } else {
            window.location.href = '/?openSearch=true';
        }
    });
});

const input = document.getElementById('searchInput');
const resultsBox = document.getElementById('searchResults');

input.addEventListener('input', async (e) => {
    const query = e.target.value.trim();

    if (!query) {
        resultsBox.innerHTML = '';
        return;
    }

    try {
        const res = await fetch(`https://api.openweathermap.org/geo/1.0/direct?q=${encodeURIComponent(query)}&limit=5&appid=${apiKey}`);
        const cities = await res.json();

        resultsBox.innerHTML = cities.length
            ? cities.map(city => `
                <div class="search-result p-2 hover:bg-gray-100 cursor-pointer rounded" data-lat="${city.lat}" data-lon="${city.lon}">
                    ${city.name}, ${city.state ? city.state + ', ' : ''}${city.country}
                </div>
            `).join('')
            : '<div class="text-gray-500">No results found</div>';
    } catch (err) {
        console.error(err);
        resultsBox.innerHTML = '<div class="text-red-500">Error fetching results</div>';
    }
});

//Saving city click in local storage
document.getElementById('searchResults').addEventListener('click', function(e) {
    const result = e.target.closest('.search-result');
    if (result) {
        const lat = result.dataset.lat;
        const lon = result.dataset.lon;
        const cityName = result.textContent.trim();

        localStorage.setItem('selectedCity', cityName);
        localStorage.setItem('selectedCoords', JSON.stringify({ lat, lon }));

        getWeatherData(parseFloat(lat), parseFloat(lon));

        document.getElementById('searchInput').value = cityName;

        document.getElementById('searchModal').classList.add('hidden');
    }
});

// Update DOMContentLoaded handler
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const savedCity = localStorage.getItem('selectedCity');

    if (savedCity && searchInput) {
        searchInput.value = savedCity;
    }

    getLocation();

});
