<?php
require_once __DIR__ . "/../../../config.php";

if(isset($_POST['update'])) {
    $stmt = $pdo->prepare("
        UPDATE matieres 
        SET nom_fr=?, nom_ar=?, description=? 
        WHERE id_matiere=?
    ");
    $stmt->execute([
        $_POST['nom_fr'],
        $_POST['nom_ar'],
        $_POST['description'],
        $_POST['id_matiere']
    ]);

    header("Location: ../matiere.php");
    exit;
}
