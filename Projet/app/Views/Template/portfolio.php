<?php
$userId = $_SESSION['user_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Views/Template/Static/portfolio.css">
    <link rel="stylesheet" href="/Views/Template/Static/toogle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My CV Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/Template/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/Template/contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Views/Template/cv.php">CV</a>
                    </li>
                    <?php if ($userId): ?>
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

    <div class="position-fixed top-left m-3">
        <a href="/Views/Template/index.php" class="position-fixed bottom-left m-3">Retour</a>
    </div>

    <div class=" container mt-5">
        <u>
            <h1 class="text-center mb-4">Mon Portfolio</h1>
        </u>

        <div class="row" id="portfolio-container">
            <!-- Les cartes seront ajoutées dynamiquement ici -->
        </div>
    </div>
    <br>
    <footer>
        <center>
            <p>&copy; 2024 My CV Portfolio | All Rights Reserved</p>
        </center>
    </footer>

    <script src="/Views/Template/js/portfolio.js"></script>
    <script src="/Views/Template/js/toogle.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>