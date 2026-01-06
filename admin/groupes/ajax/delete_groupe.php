<?php 
require_once '../../../config.php';

header('Content-Type: application/json');

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID invalide']);
    exit;
}

$id = (int) $_POST['id'];

$stmt = $pdo->prepare("
    UPDATE groupes
    SET deleted_at = NOW()
    WHERE id_groupe = :id
    AND deleted_at IS NULL
");

$ok = $stmt->execute(['id' => $id]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => true, 'message' => 'Groupe supprimé']);
} else {
    echo json_encode(['success' => false, 'message' => 'Déjà supprimé ou introuvable']);
} 

