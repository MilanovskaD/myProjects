import './bootstrap';
import './time.js';
import './weather.js';
import './location.js';
import './ui.js';
import './settings.js';


// App entry point
window.addEventListener('DOMContentLoaded', async () => {
    const savedCity = localStorage.getItem('selectedCity');
    const savedCoords = JSON.parse(localStorage.getItem('selectedCoords'));

    if (savedCity && savedCoords?.lat && savedCoords?.lon) {
        document.getElementById('searchInput').value = savedCity;
        window.useLocalTime = true;

        window.currentOffset = await getTimezoneForCoordinates(savedCoords.lat, savedCoords.lon);
        getWeatherData(parseFloat(savedCoords.lat), parseFloat(savedCoords.lon));
        updateTime(window.currentOffset);
        setTimeLabel('city', savedCity);
    } else {
        navigator.geolocation.getCurrentPosition(
            () => {
                window.useLocalTime = true;
                updateTime();
                setTimeLabel('local');
            },
            () => {
                window.useLocalTime = false;
                updateTime();
                setTimeLabel('fallback');
            }
        );
    }

    setInterval(() => updateTime(window.currentOffset), 1000);

    initSearchUI();
    getLocation();
});

