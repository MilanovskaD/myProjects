function getLocation() {
    const savedCoords = localStorage.getItem('selectedCoords');
    if (savedCoords) {
        try {
            const { lat, lon } = JSON.parse(savedCoords);
            getWeatherData(lat, lon);
            return;
        } catch (e) {
            console.error("Invalid saved coords:", e);
        }
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            pos => getWeatherData(pos.coords.latitude, pos.coords.longitude),
            err => {
                console.error("Geo error:", err);
                getWeatherData(34.0522, -118.2437); // fallback LA
            }
        );
    } else {
        getWeatherData(34.0522, -118.2437);
    }
}

window.getLocation = getLocation;
