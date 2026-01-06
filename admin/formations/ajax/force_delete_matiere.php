<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');


require_once '../../../config.php'; 

if(!$pdo){
    echo json_encode(['success'=>false,'message'=>'Erreur connexion DB']);
    exit;
}


$id = (int)($_POST['id'] ?? 0);
if($id <= 0){
    echo json_encode(['success'=>false,'message'=>'ID invalide']);
    exit;
}

//Vérifier si la formation existe
try {
    $stmtCheck = $pdo->prepare("SELECT * FROM formations WHERE id_formation = :id");
    $stmtCheck->execute(['id'=>$id]);
    $formation = $stmtCheck->fetch();
    if(!$formation){
        echo json_encode(['success'=>false,'message'=>"Formation avec ID $id non trouvée"]);
        exit;
    }

    // 4 DELETE définitif
    $stmt = $pdo->prepare("DELETE FROM formations WHERE id_formation = :id");
    $success = $stmt->execute(['id'=>$id]);

    echo json_encode([
        'success' => $success,
        'message' => $success ? "Formation $id supprimée définitivement" : 'Erreur SQL'
    ]);

} catch (PDOException $e){
    echo json_encode(['success'=>false,'message'=>'Erreur PDO: '.$e->getMessage()]);
} catch (Throwable $e){
    echo json_encode(['success'=>false,'message'=>'Erreur générale: '.$e->getMessage()]);
}
