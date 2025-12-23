<?php
require_once __DIR__ . '/../../../config.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(null);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM prospects WHERE id_prospect = ?");
$stmt->execute([$_GET['id']]);

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
