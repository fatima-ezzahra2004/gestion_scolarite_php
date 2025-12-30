<?php
require_once '../../../config.php';
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM groupes WHERE id_groupe=:id");
$stmt->execute([':id'=>$id]);
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
