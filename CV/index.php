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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CV</title>
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cv.php">CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="projects.php">Portfolio</a>
                    </li>
                    <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php"><?php echo $username; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="container">
            <h1>Welcome to My CV Portfolio</h1>
            <p>Explore my professional journey, skills, and projects.</p>
            <a href="cv.php" class="btn btn-primary">View My CV</a>
            <a href="projects.php" class="btn btn-outline-light">View My Projects</a>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2>About Me</h2>
            <p>
                I am a passionate web developer with a love for creating dynamic and engaging websites. Over the years,
                I have worked on various projects that highlight my skills in front-end and back-end development.
            </p>
            <p>
                This website is a collection of my professional work, including my CV, portfolio, and projects. Feel
                free to explore!
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <h2>Contact Me</h2>
            <p>If you’d like to get in touch, feel free to drop me a message.</p>
            <a href="contact.html" class="btn btn-primary">Contact Form</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 My CV Portfolio | All Rights Reserved</p>
    </footer>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>