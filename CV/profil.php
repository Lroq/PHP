<?php
session_start();

// Inclusion du fichier de connexion à la base de données
include 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur à partir de la session
$userId = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur
$query = "SELECT name, email, phone, profile_description FROM personal_info WHERE id = ?";
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
    $phone = $_POST['phone'];
    $profile_description = $_POST['profile_description'];

    // Mettre à jour les informations de l'utilisateur
    $updateQuery = "UPDATE personal_info SET name = ?, email = ?, phone = ?, profile_description = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    
    // Exécuter la requête de mise à jour
    if ($updateStmt->execute([$name, $email, $phone, $profile_description, $userId])) {
        echo "<script>alert('Profile updated successfully.');</script>";
        
        // Recharger les informations de l'utilisateur mises à jour
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-5">
        <h2>My Profile</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="profile_description" class="form-label">Profile Description</label>
                <textarea class="form-control" id="profile_description" name="profile_description" rows="3"
                    required><?php echo htmlspecialchars($user['profile_description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>