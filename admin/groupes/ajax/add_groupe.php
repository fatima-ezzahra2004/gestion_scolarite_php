<?php
require_once '../../../config.php';
if(empty($_POST['id_formation']) || empty($_POST['nom_fr']) || empty($_POST['nom_ar']) || empty($_POST['effectif_max'])){
    exit('Champs manquants');
}

$stmt = $pdo->prepare("INSERT INTO groupes (id_formation, nom_fr, nom_ar, effectif_max) VALUES (:idf, :nomfr, :nomar, :eff)");
$stmt->execute([
    ':idf'=>$_POST['id_formation'],
    ':nomfr'=>$_POST['nom_fr'],
    ':nomar'=>$_POST['nom_ar'],
    ':eff'=>$_POST['effectif_max']
]);
echo "Groupe ajouté!";
