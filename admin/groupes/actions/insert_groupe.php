<?php
require_once '../../config.php';

if(isset($_POST['add'])){
    $id_formation = $_POST['id_formation'];
    $nom_fr = $_POST['nom_fr'];
    $nom_ar = $_POST['nom_ar'];
    $effectif_max = $_POST['effectif_max'];

    $stmt = $pdo->prepare("INSERT INTO groupes (id_formation, nom_fr, nom_ar, effectif_max) VALUES (?,?,?,?)");
    $ok = $stmt->execute([$id_formation,$nom_fr,$nom_ar,$effectif_max]);

    echo $ok ? "✅ Groupe ajouté" : "❌ Erreur";
}
