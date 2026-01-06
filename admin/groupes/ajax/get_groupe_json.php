<?php
require_once '../../../config.php';


if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    echo json_encode(null);
    exit;
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT id_groupe, id_formation, nom_fr, nom_ar, effectif_max 
                       FROM groupes WHERE id_groupe = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$groupe = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($groupe);