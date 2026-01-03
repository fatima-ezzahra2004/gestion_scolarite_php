<?php
require "../../../config.php";

$id = $_GET['id'];

// supprimer aussi des tables liées
$pdo->prepare("DELETE FROM formation_matiere WHERE id_matiere=?")->execute([$id]);
$pdo->prepare("DELETE FROM enseignant_matiere WHERE id_matiere=?")->execute([$id]);

$pdo->prepare("DELETE FROM matieres WHERE id_matiere=?")->execute([$id]);
