<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Variables de formulaire
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validation basique
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Exemple d'envoi de mail (adapter avec votre serveur de mail)
        $to = "votre-email@domaine.com"; 
        $subject = "Contact Form: $name";
        $body = "Nom: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";

        // Envoi du mail
        if (mail($to, $subject, $body, $headers)) {
            echo "<script>Swal.fire('Message envoyé', 'Votre message a été envoyé avec succès !', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Erreur', 'L\'envoi de votre message a échoué.', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Erreur', 'Tous les champs sont obligatoires.', 'error');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Template/Static/contact.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <title>Contactez-nous</title>
    <!-- Lien Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="position-fixed top-left m-3">
        <a href="/Views/Template/index.php" class="btn btn-primary">Retour</a>
    </div>


    <div class="container mt-5">
        <div class="contact-form">
            <h1 class="contact-title"><i class="fas fa-envelope"></i> Contactez-nous</h1>
            <form method="POST" action="/Views/Template/contact.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer</button>
            </form>
        </div>
    </div>
    <br>
    <div id="map"></div>
    <br>
    <footer>
        <center>
            <p>&copy; 2024 My CV Portfolio | All Rights Reserved</p>
        </center>
    </footer>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Views/Template/js/map.js"></script>
</body>

</html>