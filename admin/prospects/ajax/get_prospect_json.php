<?php
require_once __DIR__ . '/../../../config.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(null);
    exit;
}

$stmt = $pdo->prepare("
    SELECT 
        p.*,
        t.id_tuteur,
        t.nom AS tuteur_nom,
        t.prenom AS tuteur_prenom,
        t.telephone AS tuteur_tel,
        t.lien_parente
    FROM prospects p
    LEFT JOIN tuteurs t ON p.id_tuteur = t.id_tuteur
    WHERE p.id_prospect = ?
");

$stmt->execute([$_GET['id']]);

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
