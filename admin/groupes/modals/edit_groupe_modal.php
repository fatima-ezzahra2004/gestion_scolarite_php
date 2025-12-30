<div id="editGroupeModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Modifier Groupe</h3>
            <button class="closeModal">&times;</button>
        </div>
        <form id="formEditGroupe">
            <input type="hidden" name="id_groupe">
            <label>Formation</label>
            <select name="id_formation" required id="select_formation">
                <?php
                $formations = $pdo->query("SELECT * FROM formations")->fetchAll();
                foreach($formations as $f){
                    echo "<option value='{$f['id_formation']}' style='color:#000; background-color:#fff;'>{$f['nom_fr']}</option>";
                }
                ?>
            </select>


            <label>Nom FR</label>
            <input type="text" name="nom_fr" required>

            <label>Nom AR</label>
            <input type="text" name="nom_ar" required>

            <label>Effectif Max</label>
            <input type="number" name="effectif_max" min="1" required>

            <div class="modal-footer">
                <button class="closeModal" type="button">&times;</button>

                <button type="submit">Modifier</button>
            </div>
        </form>
    </div>
</div>
