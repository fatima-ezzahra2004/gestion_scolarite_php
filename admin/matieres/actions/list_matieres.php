<?php
$recherche = trim($_GET['recherche'] ?? '');

$sqlMatieres = "
SELECT
    m.id_matiere,
    m.nom_fr,
    m.nom_ar,
    m.description,
    m.statut,
    m.deleted_at,
    COUNT(DISTINCT fm.id_formation) AS nb_formations
FROM matieres m
LEFT JOIN formation_matiere fm ON fm.id_matiere = m.id_matiere
LEFT JOIN formations f ON f.id_formation = fm.id_formation
WHERE 1=1
";

$params = [];

/* =========================
   TRASH / NORMAL
========================= */
if ($view === 'trash') {
    $sqlMatieres .= " AND m.deleted_at IS NOT NULL ";
} else {
    $sqlMatieres .= " AND m.deleted_at IS NULL ";
}

/* =========================
   RECHERCHE
========================= */
if (!empty($recherche)) {
    $sqlMatieres .= "
        AND (
            m.nom_fr LIKE :search
            OR m.nom_ar LIKE :search
            OR m.description LIKE :search
        )
    ";
    $params['search'] = "%$recherche%";
}

/* =========================
   GROUP & ORDER
========================= */
$sqlMatieres .= "
GROUP BY m.id_matiere
ORDER BY m.id_matiere DESC
";

$stmt = $pdo->prepare($sqlMatieres);
$stmt->execute($params);
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
