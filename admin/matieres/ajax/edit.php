<?php
require_once '../../../config.php';

// Validation
if (empty($_POST['id_matiere']) || empty($_POST['nom_fr']) || empty($_POST['nom_ar'])) {
    exit('Champs manquants');
}

// Update
$stmt = $pdo->prepare("
    UPDATE matieres SET
        nom_fr = :nom_fr,
        nom_ar = :nom_ar,
        description = :description,
        updated_at = NOW()
    WHERE id_matiere = :id
");

$ok = $stmt->execute([
    ':nom_fr' => $_POST['nom_fr'],
    ':nom_ar' => $_POST['nom_ar'],
    ':description' => $_POST['description'] ?? null,
    ':id' => $_POST['id_matiere']
]);

echo $ok ? 'ok' : 'Erreur';
