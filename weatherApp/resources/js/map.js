import './bootstrap';

const apiKey = '232769df58efc9ad7a0df0af2f074825';
const defaultLat = 34.0549;
const defaultLon = -118.2426;

const map = L.map('map').setView([defaultLat, defaultLon], 10);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

const popup = L.popup();
let currentMarker = null;
let currentCoords = { lat: defaultLat, lon: defaultLon };

// Handle map clicks
map.on('click', async (e) => {
    const { lat, lng } = e.latlng;
    currentCoords = { lat, lon: lng };

    // Remove old marker
    if (currentMarker) {
        map.removeLayer(currentMarker);
    }

    // Add new marker
    currentMarker = L.marker([lat, lng]).addTo(map);

    // Set popup to loading
    popup.setLatLng(e.latlng).setContent("Loading weather...").openOn(map);

    // Get weather data
    try {
        const res = await fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lng}&units=metric&appid=${apiKey}`);
        const data = await res.json();

        if (!data || !data.list || data.cod !== "200") {
            popup.setContent("Failed to load weather.");
            return;
        }

        const current = data.list[0];
        const description = current.weather[0].description;
        const temp = Math.round(current.main.temp);
        const city = data.city.name;

        popup.setContent(`
            <strong>${city}</strong><br>
            ${description}<br>
            ${temp}°C
        `);

        // Update UI
        document.getElementById('locationMapBlade').textContent = city;

    } catch (err) {
        console.error(err);
        popup.setContent("Error loading weather.");
    }

    // Show time for the clicked location
    await showTimeForCoords(lat, lng);
});

// Get city name from coordinates (used on load)
async function getCityName(lat, lon) {
    try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`);
        const data = await response.json();

        if (data && data.address) {
            return data.address.city || data.address.town || data.address.village || data.address.state || "Unknown location";
        } else {
            return "Unknown location";
        }
    } catch (error) {
        console.error("Error fetching city name:", error);
        return "Unknown location";
    }
}

// Show time using TimeZoneDB API
async function showTimeForCoords(lat, lon) {
    try {
        const response = await fetch(`https://api.timezonedb.com/v2.1/get-time-zone?key=1H706UNECZF4&format=json&by=position&lat=${lat}&lng=${lon}`);
        const data = await response.json();

        if (data.status === "OK" && data.formatted) {
            const timeOnly = data.formatted.split(' ')[1];
            document.getElementById('currentTimeMapBlade').textContent = timeOnly;
        } else {
            document.getElementById('currentTimeMapBlade').textContent = "Time unavailable";
        }
    } catch (error) {
        console.error("Time fetch error:", error);
        document.getElementById('currentTimeMapBlade').textContent = "Error loading time";
    }
}

// On load: show LA info
window.addEventListener('load', async () => {
    const city = await getCityName(defaultLat, defaultLon);
    document.getElementById('locationMapBlade').textContent = city;
    await showTimeForCoords(defaultLat, defaultLon);
});

currentMarker = L.marker([defaultLat, defaultLon]).addTo(map);
