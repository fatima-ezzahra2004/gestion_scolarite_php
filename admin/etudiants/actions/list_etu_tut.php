<?php

$recherche = $_GET['recherche'] ?? '';

$sql = "
SELECT
    e.id_etudiant,
    e.deleted_at,

    u.nom,
    u.prenom,
    u.genre,
    u.telephone,
    u.email,
    u.ville,

    t.nom AS tuteur_nom,
    t.prenom AS tuteur_prenom,
    t.telephone AS tuteur_telephone

FROM etudiants e
INNER JOIN users u ON u.id = e.user_id
LEFT JOIN tuteurs t ON t.id_tuteur = e.id_tuteur
WHERE 1
";

$params = [];

/* =========================
   TRASH / NORMAL VIEW
========================= */
if ($view === 'trash') {
    $sql .= " AND e.deleted_at IS NOT NULL ";
} else {
    $sql .= " AND e.deleted_at IS NULL ";
}

/* =========================
   SEARCH
========================= */
if (!empty($recherche)) {
    $sql .= "
    AND (
        u.nom LIKE :r
        OR u.prenom LIKE :r
        OR u.genre LIKE :r
        OR u.telephone LIKE :r
        OR u.email LIKE :r
        OR u.ville LIKE :r
        OR t.nom LIKE :r
        OR t.prenom LIKE :r
    )
    ";
    $params['r'] = "%$recherche%";
}

$sql .= " ORDER BY e.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
