<?php
session_start();

$servername = "db";
$username = "root";
$password = "root";
$dbname = "cv_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérification dans la table 'admins'
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Comparaison des mots de passe
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = 'admin'; // Role administrateur
                echo '<script type="text/javascript">window.location.href="index.php";</script>';
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            // Si l'utilisateur n'est pas trouvé dans 'admins', on vérifie dans 'user'
            $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Comparaison des mots de passe
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = 'user'; // Role utilisateur normal
                    echo '<script type="text/javascript">window.location.href="index.php";</script>';
                } else {
                    echo "Mot de passe incorrect.";
                }
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
?>