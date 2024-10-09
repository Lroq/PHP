<?php
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
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (:email, :password)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);

        if ($stmt->execute()) {
            // Afficher un message de confirmation et rediriger après quelques secondes
            echo "<script>
                    alert('Inscription réussie. Vous allez être redirigé vers la page de connexion.');
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 1000);
                  </script>";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
