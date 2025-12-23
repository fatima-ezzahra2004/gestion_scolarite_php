<?php
require 'config.php';

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = trim(htmlspecialchars($_POST['nom']));
    $prenom = trim(htmlspecialchars($_POST['prenom']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($nom && $prenom && $email && $password) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'agent'; // 🔐 rôle par défaut (sécurité)

        $sql = "INSERT INTO users (nom, prenom, email, password, role)
                VALUES (:nom, :prenom, :email, :password, :role)";

        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'password' => $hashedPassword,
                'role' => $role
            ]);

            $message = "Inscription réussie ✅";
            $type = "success";

        } catch (PDOException $e) {
            $message = "Email déjà utilisé ❌";
            $type = "error";
        }

    } else {
        $message = "Tous les champs sont obligatoires ❌";
        $type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription | EduManager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-container">

    <!-- Partie gauche -->
    <div class="auth-left">
        <h1>EduManager</h1>
        <p>Créez votre compte administrateur en toute sécurité</p>
    </div>

    <!-- Partie droite -->
    <div class="auth-right">
        <form class="auth-card" method="POST">

            <h2>Inscription</h2>
           

            <?php if (!empty($message)): ?>
                <p class="message <?= $type ?>"><?= $message ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nom" required>
            </div>

            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">S'inscrire</button>

            <div class="auth-links">
                <a href="index.php">Déjà un compte ? Se connecter</a>
            </div>

        </form>
    </div>

</div>

</body>
</html>

