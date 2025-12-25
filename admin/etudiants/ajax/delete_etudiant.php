<?php
require_once __DIR__ . '/../../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Méthode non autorisée');
}

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    exit('ID invalide');
}

// ✅ SOFT DELETE
$stmt = $pdo->prepare("
    UPDATE prospects
    SET deleted_at = NOW()
    WHERE id_prospect = ?
");

$ok = $stmt->execute([$id]);

if (!$ok) {
    http_response_code(500);
    exit('Erreur lors du soft delete');
}

echo 'deleted';
