<?php
$recherche = trim($_GET['recherche'] ?? '');

$sqlGroupes = "
SELECT
    g.id_groupe,
    g.nom_fr,
    g.nom_ar,
    g.effectif_max,
    g.effectif_actuel,
    g.deleted_at,
    f.nom AS formation_nom
FROM groupes g
LEFT JOIN formations f ON g.id_formation = f.id_formation
WHERE 1=1
";

$params = [];

/* =========================
   TRASH / NORMAL VIEW
========================= */
if ($view === 'trash') {
    $sqlGroupes .= " AND g.deleted_at IS NOT NULL ";
} else {
    $sqlGroupes .= " AND g.deleted_at IS NULL ";
}

/* =========================
   RECHERCHE
========================= */
if (!empty($recherche)) {
    $sqlGroupes .= "
        AND (
            g.nom_fr LIKE :search
            OR g.nom_ar LIKE :search
            OR f.nom LIKE :search
        )
    ";
    $params['search'] = "%$recherche%";
}

/* =========================
   ORDER (TOUJOURS À LA FIN)
========================= */
$sqlGroupes .= " ORDER BY g.id_groupe DESC";

$stmt = $pdo->prepare($sqlGroupes);
$stmt->execute($params);
$groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
