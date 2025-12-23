<?php
$recherche = trim($_GET['recherche'] ?? '');

$sqlProspects = "
SELECT
    p.id_prospect,
    p.nom,
    p.prenom,
    p.genre,
    p.telephone,
    p.email,
    p.ville,
    ep.nom AS etat,
    c.nom  AS canal,
    s.nom  AS source
FROM prospects p
LEFT JOIN etats_prospect ep ON ep.id_etat = p.id_etat
LEFT JOIN canaux c ON c.id_canal = p.id_canal
LEFT JOIN sources s ON s.id_source = p.id_source
WHERE 1=1
";

$params = [];

/* ✅ Filtre par état */
$etatSelectionne = isset($_GET['etat']) && is_numeric($_GET['etat'])
    ? (int) $_GET['etat']
    : null;

if ($etatSelectionne) {
    $sqlProspects .= " AND p.id_etat = :etat ";
    $params['etat'] = $etatSelectionne;
}

/* ✅ Recherche globale */
if (!empty($recherche)) {
    $sqlProspects .= "
        AND (
            p.nom LIKE :search
            OR p.prenom LIKE :search
            OR p.genre LIKE :search
            OR p.telephone LIKE :search
            OR p.email LIKE :search
            OR p.ville LIKE :search
            OR c.nom LIKE :search
            OR s.nom LIKE :search
            OR ep.nom LIKE :search
        )
    ";

    $params['search'] = '%' . $recherche . '%';
}

$sqlProspects .= " ORDER BY p.id_prospect DESC";

$stmt = $pdo->prepare($sqlProspects);
$stmt->execute($params);
$prospects = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>