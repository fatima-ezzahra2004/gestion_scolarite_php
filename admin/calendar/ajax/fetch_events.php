<?php
require_once __DIR__ . '/../../../config.php';

header('Content-Type: application/json; charset=utf-8');

$sql = "
SELECT
    r.id_rdv AS id,

    -- Titre principal (prospect)
    CONCAT(p.nom,' ',p.prenom) AS title,

    -- Date/heure FullCalendar
    CONCAT(
        r.date_rdv,
        ' ',
        TIME_FORMAT(r.heure_rdv, '%H:%i:%s')
    ) AS start,

    -- Infos supplémentaires
    r.type_rdv,
    r.statut,
    r.notes,
    CONCAT(e.nom_fr,' ',e.prenom_fr) AS employe,

    -- Couleur selon statut
    CASE r.statut
        WHEN 'planifié' THEN '#0ea5e9'
        WHEN 'traité'   THEN '#10b981'
        WHEN 'annulé'   THEN '#ef4444'
    END AS color

FROM rendez_vous r
JOIN prospects p ON p.id_prospect = r.id_prospect
JOIN employes e  ON e.id_employe  = r.id_employe
";

$stmt = $pdo->query($sql);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events, JSON_UNESCAPED_UNICODE);
