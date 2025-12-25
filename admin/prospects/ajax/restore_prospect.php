<?php
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    exit('Invalid ID');
}

$stmt = $pdo->prepare("
    UPDATE prospects
    SET deleted_at = NULL
    WHERE id_prospect = ?
");

$stmt->execute([$id]);

echo 'restored';
