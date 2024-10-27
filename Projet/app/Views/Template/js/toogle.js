const themeSwitch = document.querySelector('.theme-checkbox');
const body = document.body;
const navbar = document.querySelector('.navbar');

// Charger le thème sauvegardé
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-theme');
    navbar.classList.add('navbar-dark');
    navbar.classList.remove('navbar-light');
    themeSwitch.checked = true;
}

// Écouter le changement de thème
themeSwitch.addEventListener('change', () => {
    if (themeSwitch.checked) {
        body.classList.add('dark-theme');
        navbar.classList.add('navbar-dark');
        navbar.classList.remove('navbar-light');
        localStorage.setItem('theme', 'dark');
    } else {
        body.classList.remove('dark-theme');
        navbar.classList.add('navbar-light');
        navbar.classList.remove('navbar-dark');
        localStorage.setItem('theme', 'light');
    }
});