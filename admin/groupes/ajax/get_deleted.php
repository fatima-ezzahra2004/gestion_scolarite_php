<?php
require_once '../../config.php';

$deleted_groupes = $pdo->query("
    SELECT g.*, f.nom AS formation_nom
    FROM groupes g
    LEFT JOIN formations f ON g.id_formation = f.id_formation
    WHERE g.deleted_at IS NOT NULL
    ORDER BY g.deleted_at DESC
")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($deleted_groupes);
