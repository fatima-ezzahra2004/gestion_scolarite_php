<?php
require_once '../../../config.php';


if (
    empty($_POST['id_groupe']) ||
    empty($_POST['id_formation']) ||
    empty($_POST['nom_fr']) ||
    empty($_POST['effectif_max'])
) {
    exit('Champs manquants');
}

$id_groupe = (int) $_POST['id_groupe'];


$stmt = $pdo->prepare("
    UPDATE groupes SET
        id_formation   = :id_formation,
        nom_fr         = :nom_fr,
        nom_ar         = :nom_ar,
        effectif_max   = :effectif_max,
        updated_at     = NOW()
    WHERE id_groupe = :id_groupe
");

$ok = $stmt->execute([
    ':id_formation' => $_POST['id_formation'],
    ':nom_fr'       => $_POST['nom_fr'],
    ':nom_ar'       => $_POST['nom_ar'] ?? null,
    ':effectif_max' => $_POST['effectif_max'],
    ':id_groupe'    => $id_groupe
]);

echo $ok ? 'ok' : 'Erreur modification';
?>
