<?php
require_once '../../../config.php';

if (
    empty($_POST['nom_fr']) ||
    empty($_POST['nom_ar']) ||
    empty($_POST['description'])
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    INSERT INTO matieres (nom_fr, nom_ar, description)
    VALUES (:nom_fr, :nom_ar, :description)
");

$ok = $stmt->execute([
    ':nom_fr'     => $_POST['nom_fr'],
    ':nom_ar'     => $_POST['nom_ar'],
    ':description' => $_POST['description'],
]);

echo $ok ? 'ok' : 'Erreur insertion';
