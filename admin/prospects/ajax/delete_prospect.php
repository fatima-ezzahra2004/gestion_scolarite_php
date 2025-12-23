<?php
require_once __DIR__ . '/../../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Méthode non autorisée');
}

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    exit('ID invalide');
}

$stmt = $pdo->prepare("DELETE FROM prospects WHERE id_prospect = ?");
$ok = $stmt->execute([$id]);

if (!$ok) {
    http_response_code(500);
    exit('Erreur lors de la suppression');
}

echo 'success';
