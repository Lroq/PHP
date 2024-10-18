<?php
session_start();
require 'db.php';

// Mot de passe spécial pour devenir admin
$adminSecret = 'adminpass123';

try {
    $conn = new PDO("mysql:host=db;dbname=cv_db", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Vérifier s'il y a un mot de passe administrateur
        if (!empty($_POST['admin_password']) && $_POST['admin_password'] === $adminSecret) {
            // Ajouter l'utilisateur dans la table admins
            $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            if ($stmt->execute()) {
                // Connexion automatique
                $_SESSION['user_id'] = $conn->lastInsertId(); // Récupérer l'ID de l'utilisateur
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['is_admin'] = true;

                header("Location: index.php");
                exit;
            } else {
                header("Location: register.php");
                exit;
            }
        } else {
            // Ajouter l'utilisateur dans la table user (non-admin)
            $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            if ($stmt->execute()) {
                // Connexion automatique
                $_SESSION['user_id'] = $conn->lastInsertId(); // Récupérer l'ID de l'utilisateur
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['is_admin'] = false;

                header("Location: index.php");
                exit;
            } else {
                header("Location: register.php?");
                exit;
            }
        }
    }
} catch (PDOException $e) {
    header("Location: register.php" . $e->getMessage());
    exit;
}

$conn = null;
?>