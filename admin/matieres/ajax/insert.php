<?php
require "../../../config.php";

$pdo->prepare("INSERT INTO matieres(nom_fr,nom_ar,description)
VALUES(?,?,?)")->execute([
    $_POST['nom_fr'],
    $_POST['nom_ar'],
    $_POST['description']
]);
