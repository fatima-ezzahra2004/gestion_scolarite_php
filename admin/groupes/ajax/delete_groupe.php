<?php
// require_once '../../../config.php';
// $id = intval($_GET['id']);
// $pdo->prepare("DELETE FROM groupes WHERE id_groupe=:id")->execute([':id'=>$id]);
// echo "Groupe supprimé!";



// require_once '../config.php';

// if(!isset($_GET['id'])){
//     exit('ID manquant');
// }

// $id = intval($_GET['id']);

// // 1️⃣ تحديث الحالة بدل الحذف
// $stmt = $pdo->prepare("UPDATE groupes SET deleted_at = NOW() WHERE id_groupe = :id");
// $ok = $stmt->execute([':id' => $id]);

// if($ok){
//     // 2️⃣ تسجيل في historique_groupes
//     $stmtHist = $pdo->prepare("INSERT INTO historique_groupes (id_groupe, action, details, created_at) VALUES (:id, :action, :details, NOW())");
//     $stmtHist->execute([
//         ':id' => $id,
//         ':action' => 'Supprimer',
//         ':details' => 'Groupe déplacé vers Historique'
//     ]);
// }

// echo $ok ? 'Groupe supprimé (soft delete) avec succès' : 'Erreur lors de la suppression';




 require_once '../../../config.php';

$id = intval($_GET['id'] ?? 0);
if($id > 0){
    $stmt = $pdo->prepare("UPDATE groupes SET deleted_at = NOW() WHERE id_groupe = :id");
    $ok = $stmt->execute([':id' => $id]);
}

header('Content-Type: application/json');
echo json_encode([
    'success' => $ok ?? false,
    'message' => $ok ? 'Groupe déplacé vers Historique' : 'Erreur'
]);
