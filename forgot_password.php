<?php
require 'config.php';

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if ($email) {
        $token  = bin2hex(random_bytes(32));
        $expire = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $sql = "UPDATE users 
                SET reset_token = :token, token_expire = :expire 
                WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'token'  => $token,
            'expire' => $expire,
            'email'  => $email
        ]);

        if ($stmt->rowCount()) {
            $link = "http://localhost/auth-php/reset_password.php?token=$token";
            $message = "Lien de réinitialisation envoyé ✅<br><small>$link</small>";
            $type = "success";
        } else {
            $message = "Email introuvable ❌";
            $type = "error";
        }

    } else {
        $message = "Veuillez saisir un email valide ❌";
        $type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié | EduManager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-container">

    <div class="auth-left">
        <h1>EduManager</h1>
        <p>Réinitialisez votre mot de passe en toute sécurité</p>
    </div>

    <div class="auth-right">
        <form class="auth-card" method="POST">

            <h2>Mot de passe oublié</h2>
            <p class="subtitle">Recevez un lien de réinitialisation</p>

            <?php if ($message): ?>
                <p class="message <?= $type ?>"><?= $message ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <button type="submit">Envoyer le lien</button>

            <div class="auth-links">
                <a href="index.php">Retour à la connexion</a>
            </div>

        </form>
    </div>

</div>

</body>
</html>
