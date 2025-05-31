const settingsLocationID = document.getElementById('locationSettings');
const settingsTimeID = document.getElementById('currentTimeSettings');

if (settingsLocationID && settingsTimeID) {
    settingsLocationID.innerHTML = '//';
    settingsTimeID.innerHTML = '//';
}

window.useLocalTime = true;
window.currentOffset = 0;

function updateTime(offsetInSeconds = 0) {
    const now = new Date();

    if (!window.useLocalTime) {
        const options = {
            timeZone: 'America/Los_Angeles',
            hour12: true,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('currentTime').textContent =
            now.toLocaleTimeString(undefined, options);
        return;
    }

    const local = offsetInSeconds !== 0
        ? new Date(now.getTime() + (offsetInSeconds + now.getTimezoneOffset() * 60) * 1000)
        : now;

    document.getElementById('currentTime').textContent =
        local.toLocaleTimeString([], {
            hour12: true,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
}

function setTimeLabel(source, cityName = null) {
    const label = document.getElementById('timeLabel');
    if (!label) return;

    if (source === 'local') {
        label.textContent = '- Your Local Time';
    } else if (source === 'fallback') {
        label.textContent = '- Default LA Time';
    } else if (source === 'city' && cityName) {
        label.textContent = `- Time in ${cityName}`;
    } else {
        label.textContent = '';
    }
}

function isNightTimeByOffset(timezoneOffsetInSeconds) {
    try {
        const nowUTC = new Date();
        const localTime = new Date(nowUTC.getTime() + timezoneOffsetInSeconds * 1000);
        const hour = localTime.getUTCHours();
        return hour >= 20 || hour < 5;
    } catch (e) {
        const hour = new Date().getHours();
        return hour >= 20 || hour < 5;
    }
}

function getCurrentDay() {
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const now = new Date();
    return days[now.getDay()];
}

window.updateTime = updateTime;
window.setTimeLabel = setTimeLabel;
window.isNightTimeByOffset = isNightTimeByOffset;
window.getCurrentDay = getCurrentDay;
