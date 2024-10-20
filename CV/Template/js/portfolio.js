document.addEventListener('DOMContentLoaded', function() {
    fetchGitHubProjects();
});

function fetchGitHubProjects() {
    const githubUsername = 'Lroq'; // Remplace par ton nom d'utilisateur GitHub
    const apiUrl = `https://api.github.com/users/${githubUsername}/repos`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const portfolioContainer = document.getElementById('portfolio-container');
            portfolioContainer.innerHTML = ''; // Réinitialiser le contenu
            data.forEach(repo => {
                let card = document.createElement('div');
                card.classList.add('card', 'col-md-4', 'mb-4'); // Classes Bootstrap pour une meilleure mise en page
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${repo.name}</h5>
                        ${repo.description ? `<p class="card-text">${repo.description}</p>` : ''}
                        <a href="${repo.html_url}" class="btn card-button mr-2">Voir le projet</a>
                        <button class="btn btn-secondary" onclick="showReadme('${repo.name}')">Voir le README</button>
                    </div>
                `;
                portfolioContainer.appendChild(card);
            });
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des projets GitHub:', error);
        });
}

// Fonction pour afficher le contenu du README d'un projet GitHub
function showReadme(repoName) {
    const githubUsername = 'Lroq';
    const readmeUrl = `https://api.github.com/repos/${githubUsername}/${repoName}/readme`;

    fetch(readmeUrl, {
        headers: {
            'Accept': 'application/vnd.github.v3.raw'
        }
    })
    .then(response => response.text())
    .then(readmeText => {
        Swal.fire({
            title: `README de ${repoName}`,
            html: `<pre>${readmeText}</pre>`,
            confirmButtonText: 'Fermer',
            customClass: {
                popup: 'readme-popup'
            }
        });
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: `README non disponible pour le projet ${repoName}`,
        });
    });
}
