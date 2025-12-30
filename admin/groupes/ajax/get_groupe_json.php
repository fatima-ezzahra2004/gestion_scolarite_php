<?php
require_once '../../../config.php';

$stmt = $pdo->query("
    SELECT g.*, f.nom_fr AS formation_name
    FROM groupes g
    JOIN formations f ON g.id_formation = f.id_formation
    ORDER BY g.id_groupe DESC
");
$groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($groupes);
?>
