<?php
require_once '../../../config.php';


// Récupérer l'ID de la matière
$id = (int)($_POST['id'] ?? 0);

if($id <= 0){
    echo json_encode(['success' => false, 'message' => 'ID invalide']);
    exit;
}

// Restore soft delete
$stmt = $pdo->prepare("UPDATE matieres SET deleted_at = NULL WHERE id_matiere = :id");
$success = $stmt->execute(['id' => $id]);

if($success){
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Impossible de restaurer la matière']);
}
