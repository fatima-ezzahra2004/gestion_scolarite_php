<?php
require_once __DIR__ . "/../../../config.php";

if(isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO matieres (nom_fr, nom_ar, description) VALUES (?,?,?)");
    $stmt->execute([
        $_POST['nom_fr'],
        $_POST['nom_ar'],
        $_POST['description']
    ]);

    header("Location: ../matiere.php");
    exit;
}
