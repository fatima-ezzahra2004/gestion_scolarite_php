<?php
require "../../../config.php";

$pdo->prepare("UPDATE matieres SET nom_fr=?,nom_ar=?,description=? WHERE id_matiere=?")
->execute([
    $_POST['nom_fr'],
    $_POST['nom_ar'],
    $_POST['description'],
    $_POST['id']
]);
