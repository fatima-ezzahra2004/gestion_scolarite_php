<div id="modalEditEtudiant"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">

    <div class="bg-white rounded-xl w-[700px] p-6 max-h-[90vh] overflow-y-auto">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Modifier l’étudiant</h2>
            <button onclick="closeModals('modalEditEtudiant')">✕</button>
        </div>

        <form id="editFormEtudiant"
              action="ajax/update_etudiant.php"
              method="POST"
              class="grid grid-cols-2 gap-4">

            <input type="hidden" name="id_etudiant" id="edit_id">

            <input name="nom" id="edit_nom" class="input" placeholder="Nom">
            <input name="prenom" id="edit_prenom" class="input" placeholder="Prénom">
            <input name="telephone" id="edit_telephone" class="input" placeholder="Téléphone">
            <input name="email" id="edit_email" class="input" placeholder="Email">
            <input name="cin" id="edit_cin" class="input" placeholder="CIN">
            <input name="ville" id="edit_ville" class="input" placeholder="Ville">

            <select name="genre" id="edit_genre" class="input">
                <option value="">-- Genre --</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>

            <input type="date" name="date_naissance" id="edit_date_naissance" class="input">

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
                        onclick="closeModals('modalEditEtudiant')"
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
