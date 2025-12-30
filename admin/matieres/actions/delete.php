<?php
require_once __DIR__ . "/../../../config.php";


if(!isset($_GET['id'])){
    echo "ID manquant";
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM matieres WHERE id_matiere = ?");

if($stmt->execute([$id])){
    echo "Matière supprimée avec succès";
}else{
    echo "Erreur lors de la suppression";
}
