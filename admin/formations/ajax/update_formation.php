<?php
require_once '../../../config.php';

if (
    empty($_POST['id']) ||
    empty($_POST['nom']) ||
    empty($_POST['type_formation'])
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    UPDATE formations SET
        nom = :nom,
        type_formation = :type
    WHERE id_formation = :id
");

$ok = $stmt->execute([
    'nom'  => $_POST['nom'],
    'type' => $_POST['type_formation'],
    'id'   => $_POST['id'],
]);


echo $ok ? 'ok' : 'Erreur';