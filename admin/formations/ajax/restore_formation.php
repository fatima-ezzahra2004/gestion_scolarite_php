<?php

require_once '../../../config.php';
header('Content-Type: application/json');

if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
    echo json_encode(['success'=>false,'message'=>'ID invalide']);
    exit;
}

$id = (int)$_POST['id'];


$stmt = $pdo->prepare("UPDATE formations SET deleted_at = NULL WHERE id_formation = :id");
$stmt->execute(['id'=>$id]);

if($stmt->rowCount() > 0){
    echo json_encode(['success'=>true,'message'=>'Formation restaurée']);
}else{
    echo json_encode(['success'=>false,'message'=>'Déjà active ou introuvable']);
}
