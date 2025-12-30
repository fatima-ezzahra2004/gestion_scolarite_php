<div class="modal" id="addGroupeModal">
    <div class="modal-content">
        <!-- <span onclick="closeModal('addGroupeModal')">&times;</span> -->
        <button class="closeModal">&times;</button>
        <h2>Ajouter Groupe</h2>
        <form id="formAddGroupe">
            <label>Formation</label>
            <select name="id_formation" required>
                <option value="">Sélectionner</option>
                <?php
                $formations = $pdo->query("SELECT * FROM formations")->fetchAll();
                foreach($formations as $f){
                    echo "<option value='{$f['id_formation']}'>{$f['nom']}</option>";
                }
                ?>
            </select>
            <label>Nom FR</label>
            <input type="text" name="nom_fr" required>
            <label>Nom AR</label>
            <input type="text" name="nom_ar" required>
            <label>Effectif Max</label>
            <input type="number" name="effectif_max" value="30" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>
