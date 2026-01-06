<?php
require_once '../../../config.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM matieres WHERE id_matiere = :id");
$stmt->execute(['id'=>$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo $data ? json_encode($data) : 'null';
