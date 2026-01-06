<?php
// require_once '../../../config.php';

// if (empty($_POST['id'])) {
//     exit('ID manquant');
// }

// $id = (int)$_POST['id'];

// $stmt = $pdo->prepare("
//     UPDATE formations
//     SET deleted_at = NOW()
//     WHERE id_formation = :id
// ");

// $ok = $stmt->execute(['id' => $id]);

// echo $ok ? 'deleted' : 'Erreur suppression';

require_once '../../../config.php';

header('Content-Type: application/json');

if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
    echo json_encode(['success'=>false, 'message'=>'ID invalide']);
    exit;
}

$id = (int)$_POST['id'];

// حذف افتراضي (soft delete)
$stmt = $pdo->prepare("UPDATE formations SET deleted_at = NOW() WHERE id_formation = :id AND deleted_at IS NULL");
$stmt->execute(['id'=>$id]);

if($stmt->rowCount() > 0){
    echo json_encode(['success'=>true, 'message'=>'Formation supprimée']);
}else{
    echo json_encode(['success'=>false, 'message'=>'Déjà supprimée ou introuvable']);
}
