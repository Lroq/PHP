// Initialisation de la carte
var map = L.map('map').setView([43.6044622, 1.4442469], 10);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker = L.marker([43.6044622, 1.4442469]).addTo(map)
    .bindPopup('Cliquez deux fois pour agrandir la carte')
    .openPopup();

// Fonction pour passer en mode plein écran avec un double-clic
map.on('dblclick', function () {
    if (!document.fullscreenElement) {
        map.getContainer().requestFullscreen().catch(err => {
            console.log(`Erreur lors de la demande de plein écran : ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
});

// Fonction de recherche de ville
function searchCity() {
    var city = document.getElementById('citySearch').value;

    if (!city) {
        Swal.fire({
            title: 'Erreur',
            text: 'Veuillez entrer une ville.',
            icon: 'error'
        });
        return;
    }

    // Requête à l'API Nominatim pour obtenir les coordonnées de la ville
    var url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(city)}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                var lat = data[0].lat;
                var lon = data[0].lon;

                // Mettre à jour la carte et déplacer le marqueur
                map.setView([lat, lon], 12);
                marker.setLatLng([lat, lon])
                    .bindPopup(`Vous avez recherché : ${city}`)
                    .openPopup();
            } else {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Ville non trouvée.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Erreur',
                text: 'Erreur lors de la recherche de la ville.',
                icon: 'error'
            });
            console.error('Erreur:', error);
        });
}

// Ajout de la boîte de recherche sur la carte
var searchControl = L.control({ position: 'topright' });
searchControl.onAdd = function () {
    var div = L.DomUtil.create('div', 'search-box');
    div.innerHTML = `
        <input type="text" id="citySearch" placeholder="Rechercher une ville">
        <button onclick="searchCity()">Rechercher</button>
    `;
    return div;
};
searchControl.addTo(map);

// Écoute de la touche "Entrée" pour déclencher la recherche
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('citySearch').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchCity();
        }
    });
});