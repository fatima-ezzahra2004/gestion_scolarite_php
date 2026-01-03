<?php
require_once '../../../config.php';

$id_matiere = (int)($_GET['id_matiere'] ?? 0);

$stmt = $pdo->prepare("
    SELECT
        fm.id_formation_matiere,
        f.nom,
        f.type_formation,
        fm.volume_horaire,
        fm.coefficient
    FROM formation_matiere fm
    JOIN formations f ON f.id_formation = fm.id_formation
    WHERE fm.id_matiere = ?
");
$stmt->execute([$id_matiere]);
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3 class="text-sm font-semibold text-gray-600 mb-3">
    FORMATIONS ACTUELLES (<?= count($formations) ?>)
</h3>

<div class="space-y-3">
<?php foreach ($formations as $f): ?>
    <div class="flex items-center justify-between bg-gray-50 border rounded-lg p-3">

        <div>
            <p class="font-medium"><?= htmlspecialchars($f['nom']) ?></p>
            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded">
                <?= htmlspecialchars($f['type_formation']) ?>
            </span>
        </div>

        <div class="flex items-center gap-4 text-sm text-gray-600">
            <span><?= $f['volume_horaire'] ?>h</span>
            <span>Coef. <?= $f['coefficient'] ?></span>

            <button
                onclick="removeFormationFromMatiere(<?= (int)$f['id_formation_matiere'] ?>)"
                class="text-red-500 hover:text-red-700">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
<?php endforeach; ?>
</div>

<hr class="my-5">

<h3 class="text-sm font-semibold text-gray-600 mb-3">
    ASSOCIER UNE NOUVELLE FORMATION
</h3>

<form id="addFormationForm" class="space-y-3">

    <input type="hidden" name="id_matiere" value="<?= $id_matiere ?>">

    <!-- FORMATION -->
    <div>
        <label class="block text-xs text-gray-500 mb-1">Formation</label>
        <select name="id_formation" required
                class="w-full border rounded-lg px-3 py-2 text-sm">
            <option value="">-- Choisir une formation --</option>

            <?php
            $formationsAll = $pdo->query("
                SELECT id_formation, nom
                FROM formations
                WHERE deleted_at IS NULL
                ORDER BY nom
            ")->fetchAll(PDO::FETCH_ASSOC);

            foreach ($formationsAll as $fo):
            ?>
                <option value="<?= $fo['id_formation'] ?>">
                    <?= htmlspecialchars($fo['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- VOLUME -->
    <div>
        <label class="block text-xs text-gray-500 mb-1">Volume horaire (h)</label>
        <input type="number" name="volume_horaire" min="1" required
               class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <!-- COEFFICIENT -->
    <div>
        <label class="block text-xs text-gray-500 mb-1">Coefficient</label>
        <input type="number" step="0.1" min="0" name="coefficient" required
               class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700">
        + Associer cette formation
    </button>

</form>

