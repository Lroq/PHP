<?php
session_start();

// Inclusion du fichier de connexion à la base de données
include '../../Model/db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur et le rôle à partir de la session
$userId = $_SESSION['user_id'];
$role = $_SESSION['role']; // role: 'admin' ou 'user'

// Définir la table et les colonnes selon le rôle
if ($role === 'admin') {
    $table = 'admins'; // Table admin
    $columns = 'username AS name, email'; // Pour admin, récupérer uniquement username et email
} else {
    $table = 'user'; // Table user pour les utilisateurs
    $columns = 'username AS name, email'; // Récupérer uniquement username et email pour user
}

// Récupérer les informations de l'utilisateur en fonction du rôle
$query = "SELECT $columns FROM $table WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId]);

// Vérifier si l'utilisateur existe
if ($stmt->rowCount() === 0) {
    die("User not found.");
}

$user = $stmt->fetch();

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Vérifier si les champs de mot de passe sont définis et non vides
    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérification de la correspondance des mots de passe
        if ($password !== $confirm_password) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Passwords do not match.',
                        icon: 'error',
                        willClose: () => {
                            window.location.href = 'index.php';
                        }
                    });
                });
            </script>";
        } else {
            // Validation du mot de passe (minimum 8 caractères, une majuscule, un chiffre)
            if (preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
                // Hashage du mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Mise à jour du nom, de l'email et du mot de passe selon le rôle
                if ($role === 'admin') {
                    // Mise à jour dans la table admins
                    $updateQuery = "UPDATE admins SET username = ?, email = ?, password = ? WHERE id = ?";
                    $updateStmt = $pdo->prepare($updateQuery);
                    $success = $updateStmt->execute([$name, $email, $hashed_password, $userId]);
                } else {
                    // Mise à jour dans la table user
                    $updateUserQuery = "UPDATE user SET username = ?, email = ?, password = ? WHERE id = ?";
                    $updateUserStmt = $pdo->prepare($updateUserQuery);
                    $success = $updateUserStmt->execute([$name, $email, $hashed_password, $userId]);
                }

                if ($success) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Success',
                                text: 'Profile and password updated successfully.',
                                icon: 'success',
                                willClose: () => {
                                    window.location.href = 'index.php';
                                }
                            });
                        });
                    </script>";
                } else {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                title: 'Error',
                                text: 'Error updating profile or password.',
                                icon: 'error',
                                willClose: () => {
                                    window.location.href = 'index.php';
                                }
                            });
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Password must be at least 8 characters long, contain a number and an uppercase letter.',
                            icon: 'error',
                            willClose: () => {
                                window.location.href = 'index.php';
                            }
                        });
                    });
                </script>";
            }
        }
    } else {
        // Mise à jour du nom et de l'email seulement (sans mise à jour du mot de passe)
        if ($role === 'admin') {
            $updateQuery = "UPDATE admins SET username = ?, email = ? WHERE id = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $success = $updateStmt->execute([$name, $email, $userId]);
        } else {
            $updateUserQuery = "UPDATE user SET username = ?, email = ? WHERE id = ?";
            $updateUserStmt = $pdo->prepare($updateUserQuery);
            $success = $updateUserStmt->execute([$name, $email, $userId]);
        }

        if ($success) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success',
                        text: 'Profile updated successfully.',
                        icon: 'success',
                        willClose: () => {
                            window.location.href = 'index.php';
                        }
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error updating profile.',
                        icon: 'error',
                        willClose: () => {
                            window.location.href = 'index.php';
                        }
                    });
                });
            </script>";
        }
    }

    // Recharger les informations de l'utilisateur mises à jour
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Template/Static/style.css">
    <link rel="stylesheet" href="/Views/Template/Static/toogle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
     <!-- Theme Switcher -->
    <input type="checkbox" class="theme-checkbox" id="themeSwitcher">
    <div class="container mt-5">
        <h2>My Profile</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter new password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                    placeholder="Confirm new password">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <br>
    <footer>
        <center>
            <p>&copy; 2024 My CV Portfolio | All Rights Reserved</p>
        </center>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Theme Switcher -->
    <script src="/Views/Template/js/toogle.js"></script>
</body>

</html>