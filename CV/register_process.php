<?php
$servername = "db";
$username = "root";
$password = "root";
$dbname = "cv_db";

// Mot de passe spécial pour devenir admin
$adminSecret = 'adminpass123';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
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
                echo "<script>
                        alert('Inscription en tant qu\'administrateur réussie.');
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 1000);
                      </script>";
            } else {
                echo "Erreur lors de l'inscription en tant qu'administrateur.";
            }
        } else {
            // Ajouter l'utilisateur dans la table user (non-admin)
            $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Inscription réussie.');
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 1000);
                      </script>";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>