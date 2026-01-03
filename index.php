<?php

require 'config.php';

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {

        $stmt = $pdo->prepare("
            SELECT id, nom, prenom, role, password
            FROM users
            WHERE email = :email
        ");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            // 🔐 Sessions sécurisées
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom']     = $user['nom'];
            $_SESSION['role']    = $user['role'];

            // 🚦 Redirection selon rôle
            switch ($user['role']) {
                case 'admin':
                    header("Location: admin/dashboard/dashboard.php");
                    break;
                case 'agent':
                    header("Location: agent/dashboard.php");
                    break;
                case 'enseignant':
                    header("Location: enseignant/dashboard.php");
                    break;
                case 'etudiant':
                    header("Location: etudiant/dashboard.php");
                    break;
                default:
                    header("Location: dashboard.php");
            }
            exit;

        } else {
            $message = "Email ou mot de passe incorrect ❌";
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
    <title>Connexion | EduManager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-container">

    <!-- Partie gauche -->
    <div class="auth-left">
        <h1>EduManager</h1>
        <p>Connexion sécurisée</p>
    </div>

    <!-- Partie droite -->
    <div class="auth-right">
        <form class="auth-card" method="POST">

            <h2>Connexion</h2>

            <?php if (!empty($message)): ?>
                <p class="message <?= $type ?>"><?= $message ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Se connecter</button>

            <div class="auth-links">
                <a href="forgot_password.php">Mot de passe oublié ?</a>
            </div>

        </form>
    </div>

</div>

</body>
</html>
