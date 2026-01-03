<?php
$recherche = trim($_GET['recherche'] ?? '');

$sqlFormations = "
SELECT
    f.id_formation,
    f.type_formation,
    f.nom,
    f.duree,
    f.deleted_at
FROM formations f
WHERE 1=1
";

$params = [];

/* =========================
   TRASH / NORMAL VIEW
========================= */
if ($view === 'trash') {
    $sqlFormations .= " AND f.deleted_at IS NOT NULL ";
} else {
    $sqlFormations .= " AND f.deleted_at IS NULL ";
}

/* =========================
   RECHERCHE
========================= */
if (!empty($recherche)) {
    $sqlFormations .= "
        AND (
            f.nom LIKE :search
            OR f.type_formation LIKE :search
        )
    ";
    $params['search'] = "%$recherche%";
}

/* =========================
   ORDER
========================= */
$sqlFormations .= " ORDER BY f.id_formation DESC";

$stmt = $pdo->prepare($sqlFormations);
$stmt->execute($params);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   COULEURS BADGES
========================= */
function filtreColor($type_formation)
{
    return match ($type_formation) {
        'Master'              => 'border-blue-300 text-blue-600 bg-blue-50',
        'Formation'          => 'border-green-300 text-green-600 bg-green-50',
        'Technicien Spécialisé '  => 'border-emerald-300 text-emerald-600 bg-emerald-50',
        'Licence'             => 'border-red-300 text-red-600 bg-red-50',
        default               => 'border-gray-300 text-gray-600 bg-gray-50',
    };
}
?>
