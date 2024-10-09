<?php
require 'db.php'; // Database connection

// Check if the user is logged in as an admin
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'];

// Retrieve personal information of the logged-in user
$userId = $_SESSION['user_id'] ?? 1;
$stmt = $pdo->prepare('SELECT * FROM personal_info WHERE id = ?');
$stmt->execute([$userId]);
$personalInfo = $stmt->fetch();

// Process form for updating personal info (admin only)
if ($_SERVER["REQUEST_METHOD"] == "POST" && $isAdmin) {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profileDescription = $_POST['profileDescription'];
    $hobbies = $_POST['hobbies'];

    // Update personal info in the database
    $stmt = $pdo->prepare('UPDATE personal_info SET name = ?, title = ?, email = ?, phone = ?, profile_description = ? WHERE id = ?');
    $stmt->execute([$name, $title, $email, $phone, $profileDescription, $hobbies, $userId]);

    // Redirect to reflect changes
    header("Location: index.php");
    exit;
}

// Process new user creation (admin only)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_user']) && $isAdmin) {
    $newName = $_POST['new_name'];
    $newTitle = $_POST['new_title'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];
    $newProfileDescription = $_POST['new_profile_description'];
    $hobbies = $_POST['new_hobbies'];

    // Insert new user into the database
    $stmt = $pdo->prepare('INSERT INTO personal_info (name, title, email, phone, profile_description) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$newName, $newTitle, $newEmail, $newPhone, $newProfileDescription]);

    // Redirect after user creation
    header("Location: index.php");
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
        <!-- Header Section -->
        <header class="cv-header">
            <h1><?php echo $personalInfo['name']; ?></h1>
            <p class="cv-title"><?php echo $personalInfo['title']; ?></p>
            <p>Email: <?php echo $personalInfo['email']; ?> | Téléphone: <?php echo $personalInfo['phone']; ?></p>
            <?php if ($isAdmin): ?>
            <button id="editBtn">Modifier</button>
            <button id="newUserBtn">Nouvel utilisateur</button>
            <a href="logout.php">Déconnexion</a>
            <?php else: ?>
            <a href="login.php">Connexion Admin</a>
            <?php endif; ?>
        </header>

        <!-- Profile Section -->
        <section class="cv-profile">
            <h2>Profil</h2>
            <p><?php echo $personalInfo['profile_description']; ?></p>
        </section>

        <!-- Education Section -->
        <section class="cv-education">
            <h2>Éducation</h2>
            <ul>
                <li><strong>YNOV CAMPUS</strong> - Informatique (2023-2028)</li>
                <li><strong>Epitech</strong> - 1er année (2021-2022)</li>
                <li><strong>Baccalauréat Techno</strong> (Mention) (2020-2021)</li>
            </ul>
        </section>

        <!-- Experience Section -->
        <section class="cv-experience">
            <h2>Parcours Professionnel</h2>
            <ul>
                <li><strong>Insert Solutions - Castres</strong> - taff saisonnier(tous les étés)</li>
            </ul>
        </section>

        <!-- Skills Section -->
        <section class="cv-skills">
            <h2>Compétences</h2>
            <ul>
                <li>Français (Natif)</li>
                <li>Anglais (Basique)</li>
                <li>Espagnol (Basique++)</li>
            </ul>
        </section>

        <!-- Hobbies Section -->
        <section class="cv-hobbies">
            <h2>Centres d'Intérêt</h2>
            <ul>
                <li>Jeux vidéo</li>
                <li>Natation</li>
                <li>Footing</li>
            </ul>
        </section>

        <!-- Modal for editing (admin only) -->
        <?php if ($isAdmin): ?>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Modifier les informations personnelles</h2>
                <form method="POST" action="">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" value="<?php echo $personalInfo['name']; ?>" required>

                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="<?php echo $personalInfo['title']; ?>" required>

                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?php echo $personalInfo['email']; ?>" required>

                    <label for="phone">Téléphone :</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $personalInfo['phone']; ?>" required>

                    <label for="profileDescription">Description du profil :</label>
                    <textarea id="profileDescription" name="profileDescription"
                        required><?php echo $personalInfo['profile_description']; ?></textarea>

                    <input type="submit" value="Enregistrer les modifications">
                </form>
            </div>
        </div>

        <!-- Modal for new user creation (admin only) -->
        <div id="newUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Créer un nouvel utilisateur</h2>
                <form method="POST" action="">
                    <input type="hidden" name="new_user" value="1">
                    <label for="new_name">Nom :</label>
                    <input type="text" id="new_name" name="new_name" required>

                    <label for="new_title">Titre :</label>
                    <input type="text" id="new_title" name="new_title" required>

                    <label for="new_email">Email :</label>
                    <input type="email" id="new_email" name="new_email" required>

                    <label for="new_phone">Téléphone :</label>
                    <input type="text" id="new_phone" name="new_phone" required>

                    <label for="new_profile_description">Description du profil :</label>
                    <textarea id="new_profile_description" name="new_profile_description" required></textarea>

                    <input type="submit" value="Créer l'utilisateur">
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script>
    // Modal handling for editing and new user creation
    var editModal = document.getElementById("myModal");
    var newUserModal = document.getElementById("newUserModal");
    var editBtn = document.getElementById("editBtn");
    var newUserBtn = document.getElementById("newUserBtn");
    var closeBtns = document.getElementsByClassName("close");

    if (editBtn) {
        editBtn.onclick = function() {
            editModal.style.display = "block";
        }
    }

    if (newUserBtn) {
        newUserBtn.onclick = function() {
            newUserModal.style.display = "block";
        }
    }

    for (let i = 0; i < closeBtns.length; i++) {
        closeBtns[i].onclick = function() {
            editModal.style.display = "none";
            newUserModal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
        if (event.target == newUserModal) {
            newUserModal.style.display = "none";
        }
    }
    </script>
</body>

</html>