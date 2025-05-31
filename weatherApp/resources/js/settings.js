// Store preference in localStorage
const toggle = document.getElementById('unitToggle');

if (toggle) {
    // Load state
    toggle.checked = localStorage.getItem('tempUnit') === 'F';

    toggle.addEventListener('change', () => {
        const unit = toggle.checked ? 'F' : 'C';
        localStorage.setItem('tempUnit', unit);

        window.dispatchEvent(new CustomEvent('unitChanged'));
    });
}

