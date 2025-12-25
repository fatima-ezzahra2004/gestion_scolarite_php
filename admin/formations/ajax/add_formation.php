<?php
require_once '../../../config.php';

if (
    empty($_POST['type_formation']) ||
    empty($_POST['nom']) ||
    empty($_POST['date_debut']) ||
    empty($_POST['date_fin'])
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    INSERT INTO formations (type_formation, nom, date_debut, date_fin)
    VALUES (:type, :nom, :debut, :fin)
");

$ok = $stmt->execute([
    ':type'  => $_POST['type_formation'],
    ':nom'   => $_POST['nom'],
    ':debut' => $_POST['date_debut'],
    ':fin'   => $_POST['date_fin'],
]);

echo $ok ? 'ok' : 'Erreur insertion';
