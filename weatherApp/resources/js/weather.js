const apiKey = '232769df58efc9ad7a0df0af2f074825';

async function fetchWeatherData(lat, lon) {
    const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;
    const response = await fetch(apiUrl);
    return await response.json();
}

async function getCityName(latitude, longitude) {
    const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
    const data = await response.json();
    return data.address.city || data.address.town || data.address.village || data.address.county;
}

async function getTimezoneForCoordinates(lat, lon) {
    try {
        const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}`);
        const data = await response.json();
        return data.timezone;
    } catch (error) {
        console.error("Timezone fetch failed:", error);
        return 0;
    }
}

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

    document.getElementById('temperature').textContent =
        `${convertTemp(currentTemp)}°${isFahrenheit() ? 'F' : 'C'}`;
    document.getElementById('location').textContent = cityName;
    document.getElementById('current-day').textContent = getCurrentDay();

    document.getElementById('current-weather-icon').src = `/svg/wi-${getWeatherIcon(currentIconCode)}.svg`;
    document.getElementById('current-weather-icon').alt = weatherCondition;

    const videoSrc = getWeatherVideo(weatherCondition, isNight);
    const videoBg = document.getElementById('weather-video-bg');
    if (videoBg.getAttribute('src') !== videoSrc) {
        videoBg.setAttribute('src', videoSrc);
        videoBg.load();
    }

    const forecasts = processDailyForecasts(weatherData.list);
    renderWeatherCards(forecasts);
}

function getWeatherIcon(iconCode) {
    const iconMap = {
        '01d': 'day-sunny', '02d': 'day-cloudy', '03d': 'cloud', '04d': 'cloudy',
        '09d': 'rain', '10d': 'day-rain', '11d': 'thunderstorm', '13d': 'snow', '50d': 'fog',
        '01n': 'night-clear', '02n': 'night-alt-cloudy', '03n': 'cloud', '04n': 'cloudy',
        '09n': 'rain', '10n': 'night-alt-rain', '11n': 'thunderstorm', '13n': 'snow', '50n': 'fog'
    };
    return iconMap[iconCode] || 'day-sunny';
}

function getWeatherVideo(condition, isNight = false) {
    const map = {
        'clear': { day: '/videos/sunny.mp4', night: '/videos/night-clear.mp4' },
        'clouds': { day: '/videos/clouds.mp4', night: '/videos/night-clouds.mp4' },
        'rain': { day: '/videos/rain.mp4', night: '/videos/night-rain.mp4' },
        'drizzle': { day: '/videos/rain-light.mp4', night: '/videos/night-rain-light.mp4' },
        'thunderstorm': { day: '/videos/thunderstorm.mp4', night: '/videos/night-thunderstorm.mp4' },
        'snow': { day: '/videos/snow.mp4', night: '/videos/night-snow.mp4' },
        'fog': { day: '/videos/fog.mp4', night: '/videos/night-fog.mp4' }
    };

    const norm = condition.toLowerCase();
    const match = Object.keys(map).find(k => norm.includes(k)) || 'clear';
    return isNight ? map[match].night : map[match].day;
}

function processDailyForecasts(list) {
    const days = new Set();
    const today = new Date().getDay();
    return list.filter(item => {
        const date = new Date(item.dt * 1000);
        const day = date.getDay();
        const label = date.toLocaleDateString('en-US', { weekday: 'short' });
        if (day !== today && !days.has(label)) {
            days.add(label);
            return true;
        }
        return false;
    }).slice(0, 7).map(item => ({
        day: new Date(item.dt * 1000).toLocaleDateString('en-US', { weekday: 'short' }),
        temp: Math.round(item.main.temp),
        humidity: item.main.humidity,
        icon: item.weather[0].icon
    }));
}

function renderWeatherCards(forecasts) {
    const container = document.getElementById('weather-cards');
    container.innerHTML = '';
    forecasts.forEach(day => {
        container.innerHTML += `
            <div class="min-w-[150px] bg-white/10 rounded-lg p-4 text-center backdrop-blur-sm hover:bg-white/20 transition-all">
                <div class="text-lg font-semibold">${day.day}</div>
                <img src="/svg/wi-${getWeatherIcon(day.icon)}.svg" alt="${day.condition}" class="w-12 h-12 mx-auto my-2" />
                <div class="text-xl font-bold">${convertTemp(day.temp)}°${isFahrenheit() ? 'F' : 'C'}</div>
                <div class="text-sm">${day.humidity}%</div>
            </div>`;
    });
}

async function getWeatherData(lat, lon) {
    try {
        const [name, data] = await Promise.all([
            getCityName(lat, lon),
            fetchWeatherData(lat, lon)
        ]);
        document.getElementById('location').textContent = name;
        updateWeatherUI(data);
    } catch (err) {
        console.error('Weather fetch failed:', err);
        document.getElementById('location').textContent = 'Los Angeles';
        document.getElementById('temperature').textContent = 'Error';
    }
}
window.addEventListener('unitChanged', () => {
    const savedCoords = JSON.parse(localStorage.getItem('selectedCoords'));
    if (savedCoords) {
        getWeatherData(savedCoords.lat, savedCoords.lon);
    }
});

function isFahrenheit() {
    return localStorage.getItem('tempUnit') === 'F';
}

function convertTemp(tempC) {
    return isFahrenheit() ? Math.round(tempC * 9 / 5 + 32) : Math.round(tempC);
}

window.getWeatherData = getWeatherData;
window.getTimezoneForCoordinates = getTimezoneForCoordinates;
window.isFahrenheit = isFahrenheit;
