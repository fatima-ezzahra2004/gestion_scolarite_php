<?php
require_once '../../config.php';

/* =====================
   1️⃣ TUTEUR
===================== */

 $id_tuteur = null;

    if (!empty($_POST['tuteur_cin']) || !empty($_POST['tuteur_email'])) {

        $stmt = $pdo->prepare("
            SELECT id_tuteur FROM tuteurs
            WHERE cin = :cin OR email = :email
            LIMIT 1
        ");
        $stmt->execute([
            ':cin' => $_POST['tuteur_cin'] ?? null,
            ':email' => $_POST['tuteur_email'] ?? null
        ]);

        $tuteur = $stmt->fetch();

    if ($tuteur) {
        $id_tuteur = $tuteur['id_tuteur'];
        $_SESSION['alert'] = "Le tuteur existait déjà et a été lié automatiquement.";
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO tuteurs
            (nom, prenom, cin, telephone, whatsapp, email, lien_parente, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->execute([
            $_POST['tuteur_nom'] ?? null,
            $_POST['tuteur_prenom'] ?? null,
            $_POST['tuteur_cin'],
            $_POST['tuteur_telephone'] ?? null,
            $_POST['tuteur_whatsapp'] ?? null,
            $_POST['tuteur_email'] ?? null,
            $_POST['tuteur_lien_parente'] ?? null
        ]);

        $id_tuteur = $pdo->lastInsertId();
    }
}

/* =====================
   2️⃣ PROSPECT
===================== */

$stmt = $pdo->prepare("
INSERT INTO prospects
(
    nom, prenom, telephone, whatsapp, email, cin, adresse, ville,
    genre, date_naissance, nationalite,
    id_source, id_canal, id_etat, id_tuteur, created_at
)
VALUES
(
    :nom, :prenom, :telephone, :whatsapp, :email, :cin, :adresse, :ville,
    :genre, :date_naissance, :nationalite,
    :id_source, :id_canal, :id_etat, :id_tuteur, NOW()
)
");

$stmt->execute([
    ':nom'            => $_POST['nom'],
    ':prenom'         => $_POST['prenom'] ?? null,
    ':telephone'      => $_POST['telephone'] ?? null,
    ':whatsapp'       => $_POST['whatsapp'] ?? null,
    ':email'          => $_POST['email'] ?? null,
    ':cin'            => $_POST['cin'] ?? null,
    ':adresse'        => $_POST['adresse'] ?? null,
    ':ville'          => $_POST['ville'] ?? null,
    ':genre'          => $_POST['genre'],
    ':date_naissance' => $_POST['date_naissance'] ?? null,
    ':nationalite'    => $_POST['nationalite'] ?? null,
    ':id_source'      => $_POST['id_source'] ?? null,
    ':id_canal'       => $_POST['id_canal'] ?? null,
    ':id_etat'        => $_POST['id_etat'],
    ':id_tuteur'      => $id_tuteur
]);

header("Location: prospects.php");
exit;
