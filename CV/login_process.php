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

        // Hachage sécurisé du mot de passe (tu devrais enregistrer le hash en BDD)
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérification si l'utilisateur existe
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Comparer le mot de passe avec celui stocké en base de données
            if (password_verify($password, $user['password'])) {
                // Stocke le nom d'utilisateur dans la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                header("Location: index.php");
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$conn = null;
