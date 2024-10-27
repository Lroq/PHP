<?php
session_start();

// user online
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Template/Static/style.css">
    <link rel="stylesheet" href="/Views/Template/Static/toogle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CV</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My CV Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/Template/cv.php">CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/Template/portfolio.php">Portfolio</a>
                    </li>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/Template/profil.php"><?php echo $username; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/Template/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/Views/Template/login.php">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Theme Switcher -->
    <input type="checkbox" class="theme-checkbox" id="themeSwitcher">

    <div class="hero">
        <div class="container">
            <h1>Welcome to My CV Portfolio</h1>
            <p>Explore my professional journey, skills, and projects.</p>
            <a href="/Views/Template/cv.php" class="btn btn-primary">View My CV</a>
            <a href="/Views/Template/portfolio.php" class="btn btn-outline-light">View My Projects</a>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2>About Me</h2>
            <p>
                Passionné par la technologie et le développement web, je suis un développeur full-stack avec une
                expertise solide dans la création d'applications performantes et intuitives. Mon parcours m’a permis de
                maîtriser divers langages de programmation, notamment PHP, JavaScript, et Python, ainsi que des
                frameworks modernes tels que Laravel, React, et Django. Mon approche axée sur l'utilisateur me pousse à
                concevoir des solutions qui ne se contentent pas de répondre aux exigences fonctionnelles, mais qui
                offrent également une expérience utilisateur fluide et agréable.
            </p>
            <p>
                Avec une attention particulière pour les détails et une forte capacité à résoudre des problèmes, je
                m'efforce de fournir des solutions innovantes qui répondent aux besoins des utilisateurs tout en
                garantissant la qualité du code. Je crois fermement aux bonnes pratiques de développement, c'est
                pourquoi j'applique des méthodes agiles dans la gestion de mes projets, favorisant ainsi la
                collaboration et l'efficacité au sein des équipes. Mon expérience inclut également l’intégration de
                bases de données, la création d'API RESTful, et le déploiement d'applications sur des serveurs cloud
                tels qu'AWS et Heroku, me permettant d'optimiser les performances et la scalabilité des projets.
            </p>
            <p>
                En plus de mes compétences techniques, je m'intéresse de près aux nouvelles technologies et aux
                tendances émergentes du secteur, notamment le développement d'applications mobiles, le machine learning,
                et la sécurité des applications web. Je suis convaincu que l'apprentissage continu est essentiel pour
                rester pertinent dans un domaine en constante évolution, et je m'efforce toujours d'acquérir de
                nouvelles compétences par le biais de cours, de lectures, et de projets personnels.
            </p>
            <p>
                Motivé par les défis technologiques, je recherche constamment des opportunités de collaboration avec
                d'autres professionnels afin de créer des projets exceptionnels qui ont un impact positif sur les
                utilisateurs et la société. Je crois que la technologie peut être un puissant catalyseur de changement,
                et je suis déterminé à contribuer à cette évolution à travers mon travail et mes passions.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg">
        <div class="container">
            <h2>Contact Me</h2>
            <p>If you’d like to get in touch, feel free to drop me a message.</p>
            <a href="/Views/Template/contact.php" class="btn btn-primary">Contact Form</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 My CV Portfolio | All Rights Reserved</p>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Switcher -->
    <script src="/Views/Template/js/toogle.js"></script>
</body>

</html>