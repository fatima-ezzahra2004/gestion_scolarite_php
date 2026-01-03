






<div id="groupesContainer">

<?php if(!empty($groupes)): ?>
<?php foreach($groupes as $g): ?>
<div class="groupeCard">

    <!-- HEADER: title + 3 dots -->
     
    <div class="cardHeader">
        <h3><?= htmlspecialchars($g['nom_fr']) ?> / <?= htmlspecialchars($g['nom_ar']) ?></h3>

        <div class="menuContainer">
            <button class="menuBtn" onclick="toggleMenu(this)"><i class="fa-solid fa-ellipsis"></i></button>
            <div class="menuDropdown">
                <button onclick="openEdit(<?= $g['id_groupe'] ?>)">Modifier</button>
                <button class="delete" onclick="openDelete(<?= $g['id_groupe'] ?>)">Supprimer</button>
            </div>
        </div>
    </div>

    <p>Formation: <?= htmlspecialchars($g['formation_nom']) ?></p>
    <p>Effectif max: <?= $g['effectif_max'] ?></p>

            <p class="mb-1">
                <strong>Students:</strong> 
                <?= $g['student_count'] ?? 0; ?> / <?= $g['effectif_max'] ?>
                <div class="progress mt-1" style="height: 8px; background-color: #eee; border-radius: 5px;">
                    <div class="progress-bar" role="progressbar" 
                          <?= (($g['student_count'] ?? 0) / $g['effectif_max']) * 100 ?>%; 
                                >
                    </div>
                </div>
            </p>

        <div class="progress-bar" role="progressbar" 
            style="width: <?= (($g['student_count'] ?? 0) / $g['effectif_max']) * 100 ?>%">
        </div>

   
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
