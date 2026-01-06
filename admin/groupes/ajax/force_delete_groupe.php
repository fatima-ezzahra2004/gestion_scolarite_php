<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');


require_once '../../../config.php'; 

$id = (int)($_POST['id'] ?? 0);

if($id <= 0){
    echo json_encode(['success'=>false,'message'=>'ID invalide']);
    exit;
}


$stmtCheck = $pdo->prepare("SELECT * FROM groupes WHERE id_groupe = :id");
$stmtCheck->execute(['id'=>$id]);
$groupe = $stmtCheck->fetch();

if(!$groupe){
    echo json_encode(['success'=>false,'message'=>"Groupe avec ID $id non trouvé"]);
    exit;
}


$stmt = $pdo->prepare("DELETE FROM groupes WHERE id_groupe = :id");
$success = $stmt->execute(['id'=>$id]);

echo json_encode([
    'success' => $success,
    'message' => $success ? "Groupe $id supprimé définitivement" : 'Erreur SQL'
]);
