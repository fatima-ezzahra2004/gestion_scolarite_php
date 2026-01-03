<?php
require_once '../../../config.php';

if (
    empty($_POST['id']) ||
    empty($_POST['nom']) ||
    empty($_POST['type_formation']) ||
    empty($_POST['duree']) 
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    UPDATE formations SET
        nom = :nom,
        type_formation = :type,
        duree = :duree,
    WHERE id_formation = :id
");

$ok = $stmt->execute([
    'nom'   => $_POST['nom'],
    'type'  => $_POST['type_formation'],
    'duree' => $_POST['duree'],
    'id'    => $_POST['id']
]);

echo $ok ? 'ok' : 'Erreur';
