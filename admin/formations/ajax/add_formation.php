<?php
require_once '../../../config.php';

if (
    empty($_POST['type_formation']) ||
    empty($_POST['nom']) ||
    empty($_POST['duree']) 
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    INSERT INTO formations (type_formation, nom, duree)
    VALUES (:type, :nom, :duree)
");

$ok = $stmt->execute([
    ':type'  => $_POST['type_formation'],
    ':nom'   => $_POST['nom'],
    ':duree' => $_POST['duree'],
]);

echo $ok ? 'ok' : 'Erreur insertion';
