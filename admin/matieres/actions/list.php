<?php
require_once __DIR__ . "/../../../config.php";

$stmt = $pdo->query("SELECT * FROM matieres ORDER BY id_matiere DESC");
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
