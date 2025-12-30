<?php
// جلب كل المجموعات مع اسم formation الصحيح
$stmt = $pdo->query("
    SELECT g.*, f.nom AS formation_nom
    FROM groupes g
    JOIN formations f ON g.id_formation = f.id_formation
    ORDER BY g.id_groupe DESC
");
$groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);
