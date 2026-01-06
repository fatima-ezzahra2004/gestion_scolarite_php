<?php
require_once '../../../config.php';

if(!isset($_POST['id'], $_POST['nom'], $_POST['type_formation'], $_POST['date_debut'])){
    echo "Champs manquants";
    exit;
}

$id = (int)$_POST['id'];
$nom = $_POST['nom'];
$type = $_POST['type_formation'];
$duree = $_POST['date_debut'];

$stmt = $pdo->prepare("UPDATE formations SET nom=:nom, type_formation=:type, duree=:duree WHERE id_formation=:id");
$ok = $stmt->execute([
    'nom'=>$nom,
    'type'=>$type,
    'duree'=>$duree,
    'id'=>$id
]);

echo $ok ? "ok" : "Erreur update";
