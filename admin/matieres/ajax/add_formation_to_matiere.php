<?php
require __DIR__ . '/../../../config.php';

$id_matiere     = (int)$_POST['id_matiere'];
$id_formation   = (int)$_POST['id_formation'];
$volume         = (int)$_POST['volume_horaire'];
$coef           = (float)$_POST['coefficient'];

/* Vérifier doublon */
$check = $pdo->prepare("
    SELECT COUNT(*) FROM formation_matiere
    WHERE id_matiere = ? AND id_formation = ?
");
$check->execute([$id_matiere, $id_formation]);

if ($check->fetchColumn() > 0) {
    exit('Cette formation est déjà associée.');
}

/* Insertion */
$stmt = $pdo->prepare("
    INSERT INTO formation_matiere
    (id_matiere, id_formation, volume_horaire, coefficient)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$id_matiere, $id_formation, $volume, $coef]);

echo 'ok';
