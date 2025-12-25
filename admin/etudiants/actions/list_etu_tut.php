<?php

$recherche = $_GET['recherche'] ?? '';

$sql = "
SELECT
    e.id_etudiant,
    e.nom,
    e.prenom,
    e.genre,
    e.telephone,
    e.email,
    e.ville,

    t.nom AS tuteur_nom,
    t.prenom AS tuteur_prenom,
    t.telephone AS tuteur_telephone

FROM etudiants e
LEFT JOIN tuteurs t ON t.id_tuteur = e.id_tuteur
WHERE 1
";

$params = [];

if (!empty($recherche)) {
    $sql .= "
    AND (
        e.nom LIKE :r
        OR e.prenom LIKE :r
        OR e.genre LIKE :r
        OR e.telephone LIKE :r
        OR e.email LIKE :r
        OR t.nom LIKE :r
        OR t.prenom LIKE :r
    )
    ";
    $params[':r'] = "%$recherche%";
}

$sql .= " ORDER BY e.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
