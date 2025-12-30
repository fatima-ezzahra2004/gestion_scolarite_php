<?php
require_once '../../../config.php';
if(empty($_POST['id_groupe'])) exit('Erreur');
$stmt = $pdo->prepare("UPDATE groupes SET id_formation=:idf, nom_fr=:nomfr, nom_ar=:nomar, effectif_max=:eff WHERE id_groupe=:id");
$stmt->execute([
    ':idf'=>$_POST['id_formation'],
    ':nomfr'=>$_POST['nom_fr'],
    ':nomar'=>$_POST['nom_ar'],
    ':eff'=>$_POST['effectif_max'],
    ':id'=>$_POST['id_groupe']
]);
echo "Groupe modifié!";
