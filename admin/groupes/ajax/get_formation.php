<?php
require_once '../../../config.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT
        nom,
        type_formation,
        duree,
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
        <span class="text-gray-500 text-xs">Duree</span>
        <p class="font-medium">
         <?= htmlspecialchars($f['duree']) ?>
        </p>
    </div>


    <div class="col-span-2">
        <span class="text-gray-500 text-xs">Créée le</span>
        <p class="font-medium">
            <?= date('d/m/Y H:i', strtotime($f['created_at'])) ?>
        </p>
    </div>

</div>
