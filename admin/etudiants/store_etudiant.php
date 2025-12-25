<?php
require_once '../../config.php';
session_start();

try {
    // 🔒 Sécurité minimale
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['genre']) || empty($_POST['civilite'])) {
        throw new Exception("Champs obligatoires manquants");
    }

    // 🔁 DÉMARRER TRANSACTION
    $pdo->beginTransaction();

    // ================= TUTEUR =================
    $id_tuteur = null;

    if (!empty($_POST['tuteur_cin']) || !empty($_POST['tuteur_email'])) {

        $stmt = $pdo->prepare("
            SELECT id_tuteur
            FROM tuteurs
            WHERE cin = :cin OR email = :email
            LIMIT 1
        ");
        $stmt->execute([
            ':cin'   => $_POST['tuteur_cin'] ?? null,
            ':email' => $_POST['tuteur_email'] ?? null
        ]);

        $tuteur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tuteur) {
            // ✅ Tuteur existe
            $id_tuteur = $tuteur['id_tuteur'];
            $_SESSION['alert'] = "⚠️ Le tuteur existait déjà et a été lié automatiquement.";
        } else {
            // ➕ Nouveau tuteur
            $stmt = $pdo->prepare("
                INSERT INTO tuteurs
                (nom, prenom, cin, telephone, whatsapp, email, lien_parente, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");

            $stmt->execute([
                $_POST['tuteur_nom'] ?? null,
                $_POST['tuteur_prenom'] ?? null,
                $_POST['tuteur_cin'] ?? null,
                $_POST['tuteur_telephone'] ?? null,
                $_POST['tuteur_whatsapp'] ?? null,
                $_POST['tuteur_email'] ?? null,
                $_POST['tuteur_lien_parente'] ?? null
            ]);

            $id_tuteur = $pdo->lastInsertId();
        }
    }

    // ================= ÉTUDIANT =================
    $stmt = $pdo->prepare("
        INSERT INTO etudiants
        (nom, prenom, genre, civilite, date_naissance,
         nationalite, cin, email, telephone, whatsapp,
         adresse, ville, id_tuteur, created_at)
        VALUES
        (:nom, :prenom, :genre, :civilite, :dn,
         :nat, :cin, :email, :tel, :wa,
         :adresse, :ville, :id_tuteur, NOW())
    ");

    $stmt->execute([
        ':nom'       => $_POST['nom'],
        ':prenom'    => $_POST['prenom'],
        ':genre'     => $_POST['genre'],
        ':civilite'  => $_POST['civilite'],
        ':dn'        => $_POST['date_naissance'] ?: null,
        ':nat'       => $_POST['nationalite'] ?: null,
        ':cin'       => $_POST['cin'] ?: null,
        ':email'     => $_POST['email'] ?: null,
        ':tel'       => $_POST['telephone'] ?: null,
        ':wa'        => $_POST['whatsapp'] ?: null,
        ':adresse'   => $_POST['adresse'] ?: null,
        ':ville'     => $_POST['ville'] ?: null,
        ':id_tuteur' => $id_tuteur
    ]);

    // ✅ TOUT OK
    $pdo->commit();

    header('Location: etudiants.php?success=1');
    exit;

} catch (Exception $e) {

    // ❌ ANNULATION
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['alert'] = "❌ Erreur : " . $e->getMessage();
    header('Location: etudiants.php?error=1');
    exit;
}

