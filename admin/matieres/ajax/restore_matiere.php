<?php
require_once '../../../config.php';

$id = (int)($_POST['id'] ?? 0);

$stmt = $pdo->prepare("
    UPDATE formations
    SET deleted_at = NULL
    WHERE id_formation = :id
");

echo $stmt->execute(['id'=>$id]) ? 'restored' : 'error';
