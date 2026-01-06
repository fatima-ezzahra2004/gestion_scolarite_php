<?php
header('Content-Type: application/json');
require_once '../../../config.php'; // path correct

// Récupérer l'ID de la matière
$id = (int)($_POST['id'] ?? 0);

if($id <= 0){
    echo json_encode(['success' => false, 'message' => 'ID invalide']);
    exit;
}

// Supprimer définitivement
$stmt = $pdo->prepare("DELETE FROM matieres WHERE id_matiere = :id");
$success = $stmt->execute(['id' => $id]);

if($success){
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Impossible de supprimer la matière']);
}
