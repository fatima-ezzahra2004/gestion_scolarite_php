<?php
require_once '../../../config.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT
        nom,
        type_formation,
        date_debut,
        date_fin,
        created_at
    FROM formations
    WHERE id_formation = :id
");

$stmt->execute(['id' => $id]);
$f = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$f) {
    echo '<p class="text-red-500">Formation introuvable</p>';
    exit;
}
?>

<div class="grid grid-cols-2 gap-4">

    <div>
        <span class="text-gray-500 text-xs">Nom</span>
        <p class="font-medium"><?= htmlspecialchars($f['nom']) ?></p>
    </div>

    <div>
        <span class="text-gray-500 text-xs">Type</span>
        <p class="font-medium"><?= htmlspecialchars($f['type_formation']) ?></p>
    </div>

    <div>
        <span class="text-gray-500 text-xs">Date début</span>
        <p class="font-medium">
            <?= date('d/m/Y', strtotime($f['date_debut'])) ?>
        </p>
    </div>

    <div>
        <span class="text-gray-500 text-xs">Date fin</span>
        <p class="font-medium">
            <?= date('d/m/Y', strtotime($f['date_fin'])) ?>
        </p>
    </div>

    <div class="col-span-2">
        <span class="text-gray-500 text-xs">Créée le</span>
        <p class="font-medium">
            <?= date('d/m/Y H:i', strtotime($f['created_at'])) ?>
        </p>
    </div>

</div>
