<?php
require_once __DIR__ . '/../../../config.php';

if (!isset($_POST['id'])) exit;

$id = (int) $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM prospects WHERE id_prospect = ?");
$stmt->execute([$id]);
