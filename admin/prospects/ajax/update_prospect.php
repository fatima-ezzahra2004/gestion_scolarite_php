<?php
require_once __DIR__ . '/../../../config.php';

$id = $_POST['id_prospect'] ?? null;

if (!$id) {
    exit('error');
}

/* ===============================
   1️⃣ UPDATE PROSPECT
================================ */

$sql = "
UPDATE prospects SET
    nom = :nom,
    prenom = :prenom,
    telephone = :telephone,
    whatsapp = :whatsapp,
    email = :email,
    cin = :cin,
    ville = :ville,
    nationalite = :nationalite,
    genre = :genre,
    date_naissance = :date_naissance,
    id_canal = :id_canal,
    id_source = :id_source,
    id_etat = :id_etat,
    adresse = :adresse
WHERE id_prospect = :id
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nom' => $_POST['nom'] ?? null,
    'prenom' => $_POST['prenom'] ?? null,
    'telephone' => $_POST['telephone'] ?? null,
    'whatsapp' => $_POST['whatsapp'] ?? null,
    'email' => $_POST['email'] ?? null,
    'cin' => $_POST['cin'] ?? null,
    'ville' => $_POST['ville'] ?? null,
    'nationalite' => $_POST['nationalite'] ?? null,
    'genre' => $_POST['genre'] ?? null,
    'date_naissance' => $_POST['date_naissance'] ?? null,
    'id_canal' => $_POST['id_canal'] ?? null,
    'id_source' => $_POST['id_source'] ?? null,
    'id_etat' => $_POST['id_etat'] ?? null,
    'adresse' => $_POST['adresse'] ?? null,
    'id' => $id
]);

/* ===============================
   2️⃣ GESTION DU TUTEUR
================================ */

$tuteur_nom     = $_POST['tuteur_nom'] ?? null;
$tuteur_prenom  = $_POST['tuteur_prenom'] ?? null;
$tuteur_tel     = $_POST['tuteur_tel'] ?? null;
$lien_parente   = $_POST['lien_parente'] ?? null;

// S'il y a au moins une info tuteur
if ($tuteur_nom || $tuteur_prenom || $tuteur_tel || $lien_parente) {

    // Prospect a-t-il déjà un tuteur ?
    $stmt = $pdo->prepare("SELECT id_tuteur FROM prospects WHERE id_prospect = ?");
    $stmt->execute([$id]);
    $id_tuteur = $stmt->fetchColumn();

    if ($id_tuteur) {
        // 🔁 UPDATE tuteur existant
        $stmt = $pdo->prepare("
            UPDATE tuteurs SET
                nom = :nom,
                prenom = :prenom,
                telephone = :telephone,
                lien_parente = :lien
            WHERE id_tuteur = :id
        ");
        $stmt->execute([
            'nom' => $tuteur_nom,
            'prenom' => $tuteur_prenom,
            'telephone' => $tuteur_tel,
            'lien' => $lien_parente,
            'id' => $id_tuteur
        ]);
    } else {
        // ➕ INSERT nouveau tuteur
        $stmt = $pdo->prepare("
            INSERT INTO tuteurs (nom, prenom, telephone, lien_parente)
            VALUES (:nom, :prenom, :telephone, :lien)
        ");
        $stmt->execute([
            'nom' => $tuteur_nom,
            'prenom' => $tuteur_prenom,
            'telephone' => $tuteur_tel,
            'lien' => $lien_parente
        ]);

        $newTuteurId = $pdo->lastInsertId();

        // 🔗 Lier le tuteur au prospect
        $pdo->prepare("
            UPDATE prospects SET id_tuteur = ?
            WHERE id_prospect = ?
        ")->execute([$newTuteurId, $id]);
    }
}

echo 'success';
