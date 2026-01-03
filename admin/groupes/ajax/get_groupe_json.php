<?php
require_once '../../../config.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT 
        id_formation,
        nom,
        type_formation,
        duree
    FROM formations
    WHERE id_formation = :id
");


$stmt->execute(['id' => $id]);

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
