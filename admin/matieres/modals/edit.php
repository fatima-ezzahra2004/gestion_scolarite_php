<?php
require "../../../config.php";

$id = $_GET['id'];
$m = $pdo->prepare("SELECT * FROM matieres WHERE id_matiere=?");
$m->execute([$id]);
$mat = $m->fetch();
?>
<div id="modalProspect" class="modal">
    <div class="modal-content">
        <span id="close">&times;</span>
        <div id="modalBody">
<form method="POST" action="ajax/update.php" id="editMatiereForm">
    <input type="hidden" name="id" value="<?= $mat['id_matiere'] ?>">

    <label>Nom (FR)</label>
    <input type="text" name="nom_fr" class="input" id="nom_fr" value="<?= htmlspecialchars($mat['nom_fr']) ?>" required>

    <label>Nom (AR)</label>
    <input type="text" name="nom_ar" class="input" id="nom_ar" value="<?= htmlspecialchars($mat['nom_ar']) ?>">

    <label>Description</label>
    <textarea name="description" class="input" id="description"><?= htmlspecialchars($mat['description']) ?></textarea>

    <div class="modal-footer" style="text-align:right; margin-top:10px;">
        <button type="submit" class="btn-save">Modifier</button>
    </div>
</form>

        </div>
    </div>
</div>
