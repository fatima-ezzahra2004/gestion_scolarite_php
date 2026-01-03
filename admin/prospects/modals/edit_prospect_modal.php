
<div id="modalEdit"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl w-[700px] p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Modifier le prospect</h2>
            <button onclick="closeEdit('modalEdit')">✕</button>
        </div>

        <form id="editForm" class="grid grid-cols-2 gap-4">
            <input type="hidden" name="id_prospect" id="edit_id">

            <input type="text" name="nom" id="edit_nom" class="input" placeholder="Nom">
            <input type="text" name="prenom" id="edit_prenom" class="input" placeholder="Prénom">

            <input type="text" name="telephone" id="edit_telephone" class="input" placeholder="Téléphone">
            <input type="text" name="whatsapp" id="edit_whatsapp" class="input" placeholder="WhatsApp">

            <input type="email" name="email" id="edit_email" class="input" placeholder="Email">
            <input type="text" name="cin" id="edit_cin" class="input" placeholder="CIN">

            <input type="text" name="ville" id="edit_ville" class="input" placeholder="Ville">
            <input type="text" name="nationalite" id="edit_nationalite" class="input" placeholder="Nationalité">

            <select name="genre" id="edit_genre" class="input">
                <option value="">-- Genre --</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>

          
            <input type="date" name="date_naissance" id="edit_date_naissance" class="input">

            <select name="id_canal" id="edit_canal" class="input">
               <option value="">Canal</option>
                    <?php
                    $canaux = $pdo->query("SELECT * FROM canaux")->fetchAll();
                    foreach ($canaux as $c) {
                        echo "<option value='{$c['id_canal']}'>{$c['nom']}</option>";
                    }
                    ?>
            </select>

            <select name="id_source" id="edit_source" class="input">
                 <option value="">Source</option>
                    <?php
                    $sources = $pdo->query("SELECT * FROM sources")->fetchAll();
                    foreach ($sources as $s) {
                        echo "<option value='{$s['id_source']}'>{$s['nom']}</option>";
                    }
                    ?>
            </select>

            <select name="id_etat" id="edit_etat" class="input">
                <?php
                    foreach ($etats as $e) {
                        echo "<option value='{$e['id_etat']}'>{$e['nom']}</option>";
                    }
                    ?>
            </select>

            <textarea name="adresse" id="edit_adresse"
                      class="input col-span-2"
                      placeholder="Adresse"></textarea>
     <!-- TUTEUR -->
<div class="col-span-2 mt-4 font-semibold">Parent / Tuteur</div>

<input name="tuteur_nom" id="edit_tuteur_nom" class="input" placeholder="Nom tuteur">
<input name="tuteur_prenom" id="edit_tuteur_prenom" class="input" placeholder="Prénom tuteur">

<input name="tuteur_tel" id="edit_tuteur_tel" class="input" placeholder="Téléphone tuteur">

<select name="lien_parente" id="edit_lien_parente" class="input">
<option value="">-- Lien de parenté --</option>
                            <option value="Père">Père</option>
                            <option value="Mère">Mère</option>
                            <option value="Tuteur">Tuteur</option>
</select>

            <div class="col-span-2 flex justify-end gap-3 mt-4">
                <button type="button"
                        onclick="closeEdit('modalEdit')"
                        class="px-4 py-2 border rounded">
                    Annuler
                </button>
                <button class="px-5 py-2 bg-teal-600 text-white rounded">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
