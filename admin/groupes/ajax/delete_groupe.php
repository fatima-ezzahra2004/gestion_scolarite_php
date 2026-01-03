<?php
require_once '../../../config.php';

if (empty($_POST['id'])) {
    exit('ID manquant');
}

$id = (int)$_POST['id'];

$stmt = $pdo->prepare("
    UPDATE formations
    SET deleted_at = NOW()
    WHERE id_formation = :id
");

$ok = $stmt->execute(['id' => $id]);

echo $ok ? 'deleted' : 'Erreur suppression';
