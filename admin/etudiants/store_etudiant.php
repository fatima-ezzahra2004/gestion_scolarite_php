<?php
require_once '../../config.php';
session_start();
include 'actions/upload.php';

try {

    /* ===============================
       🔐 VALIDATION
    ================================ */
    if (empty($_POST['user_id']) || empty($_POST['niveau_etude'])) {
        throw new Exception("Champs obligatoires manquants");
    }

    $pdo->beginTransaction();

    /* ===============================
       1️⃣ RÉCUPÉRER LE TUTEUR DU PROSPECT
    ================================ */
    $stmt = $pdo->prepare("
        SELECT p.id_tuteur
        FROM prospects p
        INNER JOIN users u ON u.email = p.email
        WHERE u.id = ?
        LIMIT 1
    ");
    $stmt->execute([$_POST['user_id']]);
    $prospect = $stmt->fetch(PDO::FETCH_ASSOC);

    $id_tuteur = $prospect['id_tuteur'] ?? null;

   /* ===============================
   📎 UPLOAD DOCUMENTS
================================ */
$pdf_cin       = uploadFile('pdf_cin');
$pdf_profil    = uploadFile('pdf_profil');
$diplome_scan  = uploadFile('diplome_scan');

/* ===============================
   2️⃣ INSÉRER L’ÉTUDIANT
================================ */
$stmt = $pdo->prepare("
    INSERT INTO etudiants
    (
        user_id,
        niveau_etude,
        id_tuteur,
        pdf_cin,
        pdf_profil,
        diplome_scan,
        created_at
    )
    VALUES (?, ?, ?, ?, ?, ?, NOW())
");

$stmt->execute([
    $_POST['user_id'],
    $_POST['niveau_etude'],
    $id_tuteur,
    $pdf_cin,
    $pdf_profil,
    $diplome_scan
]);

    $pdo->commit();

    $_SESSION['alert'] = "✅ Profil étudiant créé avec succès.";
    header('Location: etudiants.php');
    exit;

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['alert'] = "❌ Erreur : " . $e->getMessage();
    header('Location: etudiants.php');
    exit;
}
