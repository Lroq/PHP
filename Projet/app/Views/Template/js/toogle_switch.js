const themeCheckbox = document.getElementById('themeSwitcher');
const body = document.body;
// Charger le thème sauvegardé dans localStorage
if (localStorage.getItem('darkTheme') === 'true') {
    body.classList.add('dark-theme');
    themeCheckbox.checked = true;
}

// Basculer le thème et enregistrer dans localStorage
themeCheckbox.addEventListener('change', () => {
    if (themeCheckbox.checked) {
        body.classList.add('dark-theme');
        localStorage.setItem('darkTheme', 'true');
    } else {
        body.classList.remove('dark-theme');
        localStorage.setItem('darkTheme', 'false');
    }
});