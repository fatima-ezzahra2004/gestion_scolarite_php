<?php
require_once '../../../config.php';

header('Content-Type: application/json');

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    echo json_encode(null);
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT id_formation, nom, type_formation, duree FROM formations WHERE id_formation = :id");
$stmt->execute(['id'=>$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($data);
