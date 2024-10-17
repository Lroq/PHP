<?php
session_start();
require 'db.php'; // Connexion à la base de données

// Récupérer l'ID utilisateur en session
$userId = $_SESSION['user_id'] ?? null;

// Rediriger si l'utilisateur n'est pas connecté
if (!$userId) {
    header("Location: login.php");
    exit;
}

// Vérifier si l'utilisateur est un admin
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM personal_info WHERE id = ?');
$stmt->execute([$userId]);
$personalInfo = $stmt->fetch();

// Si les informations n'existent pas, en créer de nouvelles avec des valeurs par défaut
if (!$personalInfo) {
    // Insérer de nouvelles informations par défaut pour cet utilisateur
    $stmt = $pdo->prepare('INSERT INTO personal_info (id, name, title, email, phone, profile_description, education, experience_pro, hobbies, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$userId, 'Nom par défaut', 'Titre par défaut', 'email@exemple.com', '0123456789', 'Description par défaut', 'ynov campus', 'insert solutions', 'tennis, footing', 'html, css, js']); // Valeurs par défaut

    
    // Récupérer à nouveau les informations après l'insertion
    $stmt = $pdo->prepare('SELECT * FROM personal_info WHERE id = ?');
    $stmt->execute([$userId]);
    $personalInfo = $stmt->fetch();
}

// Processus de modification du CV
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_cv'])) {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profileDescription = $_POST['profileDescription'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $hobbies = $_POST['hobbies'];

    // Mettre à jour les informations existantes
    $stmt = $pdo->prepare('UPDATE personal_info SET name = ?, title = ?, email = ?, phone = ?, profile_description = ?, education = ?, experience_pro = ?, skills = ?, hobbies = ? WHERE id = ?');
    $stmt->execute([$name, $title, $email, $phone, $profileDescription, $education, $experience, $skills, $hobbies, $userId]);

    // Rediriger pour afficher les changements
    header("Location: cv.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="cv.css">
</head>

<body>
    <div class="container">
        <!-- Section en-tête -->
        <header class="cv-header">
            <h1><?php echo htmlspecialchars($personalInfo['name']); ?></h1>
            <p class="cv-title"><?php echo htmlspecialchars($personalInfo['title']); ?></p>
            <p>Email: <?php echo htmlspecialchars($personalInfo['email']); ?> | Téléphone:
                <?php echo htmlspecialchars($personalInfo['phone']); ?></p>
            <button id="editBtn">Modifier</button>
            <?php if ($isAdmin): ?>
            <a href="admin_dashboard.php">Gestion des utilisateurs</a>
            <?php endif; ?>
            <a href="logout.php">Déconnexion</a>
        </header>

        <!-- Section Profil -->
        <section class="cv-profile">
            <h2>Profil</h2>
            <p><?php echo htmlspecialchars($personalInfo['profile_description']); ?></p>
        </section>

        <!-- Section Éducation -->
        <section class="cv-education">
            <h2>Éducation</h2>
            <p><?php echo htmlspecialchars($personalInfo['education']); ?></p>
        </section>

        <!-- Section Expérience -->
        <section class="cv-experience">
            <h2>Expérience Professionnelle</h2>
            <p><?php echo htmlspecialchars($personalInfo['experience']); ?></p>
        </section>

        <!-- Section Compétences -->
        <section class="cv-skills">
            <h2>Compétences</h2>
            <p><?php echo htmlspecialchars($personalInfo['skills']); ?></p>
        </section>

        <!-- Section Hobbies -->
        <section class="cv-hobbies">
            <h2>Centres d'Intérêt</h2>
            <p><?php echo htmlspecialchars($personalInfo['hobbies']); ?></p>
        </section>

        <!-- Modal pour modifier les informations -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Modifier le CV</h2>
                <form method="POST" action="">
                    <input type="hidden" name="update_cv" value="1">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name"
                        value="<?php echo htmlspecialchars($personalInfo['name']); ?>" required>

                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title"
                        value="<?php echo htmlspecialchars($personalInfo['title']); ?>" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo htmlspecialchars($personalInfo['email']); ?>" required>

                    <label for="phone">Téléphone :</label>
                    <input type="text" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($personalInfo['phone']); ?>" required>

                    <label for="profileDescription">Description du profil :</label>
                    <textarea id="profileDescription" name="profileDescription"
                        required><?php echo htmlspecialchars($personalInfo['profile_description']); ?></textarea>

                    <label for="education">Éducation :</label>
                    <textarea id="education" name="education"
                        required><?php echo htmlspecialchars($personalInfo['education']); ?></textarea>

                    <label for="experience">Expérience Professionnelle :</label>
                    <textarea id="experience" name="experience"
                        required><?php echo htmlspecialchars($personalInfo['experience']); ?></textarea>

                    <label for="skills">Compétences :</label>
                    <textarea id="skills" name="skills"
                        required><?php echo htmlspecialchars($personalInfo['skills']); ?></textarea>

                    <label for="hobbies">Centres d'Intérêt :</label>
                    <textarea id="hobbies" name="hobbies"
                        required><?php echo htmlspecialchars($personalInfo['hobbies']); ?></textarea>

                    <input type="submit" value="Enregistrer les modifications">
                </form>
            </div>
        </div>

    </div>

    <script>
    // Gestion du modal pour modifier
    var modal = document.getElementById("myModal");
    var editBtn = document.getElementById("editBtn");
    var closeBtn = document.getElementsByClassName("close")[0];

    editBtn.onclick = function() {
        modal.style.display = "block";
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
</body>

</html>