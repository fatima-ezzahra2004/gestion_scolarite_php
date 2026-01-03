<?php
require_once __DIR__ . '/../../../config.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(null);
    exit;
}

$stmt = $pdo->prepare("
    SELECT
        e.*,
        t.id_tuteur,
        t.nom AS tuteur_nom,
        t.prenom AS tuteur_prenom,
        t.telephone AS tuteur_tel,
        t.lien_parente
    FROM etudiants e
    LEFT JOIN tuteurs t ON t.id_tuteur = e.id_tuteur
    WHERE e.id_etudiant = ?
");

$stmt->execute([$_GET['id']]);
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
