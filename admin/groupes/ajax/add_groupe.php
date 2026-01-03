<?php
require_once '../../../config.php';

if (
    empty($_POST['id_formation']) ||
    empty($_POST['nom_fr']) ||
    empty($_POST['effectif_max'])
) {
    exit('Champs manquants');
}

$stmt = $pdo->prepare("
    INSERT INTO groupes (
        id_formation,
        nom_fr,
        nom_ar,
        effectif_max,
        effectif_actuel,
        created_at,
        updated_at
    ) VALUES (
        :id_formation,
        :nom_fr,
        :nom_ar,
        :effectif_max,
        0,
        NOW(),
        NOW()
    )
");

$ok = $stmt->execute([
    ':id_formation'   => $_POST['id_formation'],
    ':nom_fr'         => $_POST['nom_fr'],
    ':nom_ar'         => $_POST['nom_ar'] ?? null,
    ':effectif_max'   => $_POST['effectif_max'],
]);

echo $ok ? 'ok' : 'Erreur insertion';
?>