<?php
 require_once '../../../config.php';


$id = intval($_GET['id'] ?? 0);
if($id > 0){
    $stmt = $pdo->prepare("UPDATE groupes SET deleted_at = NULL WHERE id_groupe = :id");
    $ok = $stmt->execute([':id' => $id]);
}

header('Content-Type: application/json');
echo json_encode([
    'success' => $ok ?? false,
    'message' => $ok ? 'Groupe restauré avec succès' : 'Erreur'
]);
