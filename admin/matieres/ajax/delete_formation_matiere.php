<?php
require_once '../../../config.php';

$id = (int)($_POST['id'] ?? 0);

$stmt = $pdo->prepare("
    DELETE FROM formation_matiere
    WHERE id_formation_matiere = ?
");
$stmt->execute([$id]);
