<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$sqlEtats = "
SELECT 
    ep.id_etat,
    ep.nom,
    COUNT(p.id_prospect) AS total
FROM etats_prospect ep
LEFT JOIN prospects p 
    ON p.id_etat = ep.id_etat
    AND p.deleted_at IS NULL
GROUP BY ep.id_etat, ep.nom
ORDER BY ep.id_etat
";

$etats = $pdo->query($sqlEtats)->fetchAll(PDO::FETCH_ASSOC);
$totalProspects = array_sum(array_column($etats, 'total'));



?>