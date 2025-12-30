<div id="historiqueGroupes" style="display:none;">
    <h2 class="col-span-4">Historique</h2>

    <?php foreach($deleted_groupes as $g): ?>
        <div class="groupeCard deleted">
            <h3><?= htmlspecialchars($g['nom_fr']) ?> / <?= htmlspecialchars($g['nom_ar']) ?></h3>
            <p>Formation: <?= htmlspecialchars($g['formation_nom']) ?></p>
            <button onclick="openRestoreModal(<?= $g['id_groupe'] ?>)">Restaurer</button>
        </div>
    <?php endforeach; ?>
</div>
