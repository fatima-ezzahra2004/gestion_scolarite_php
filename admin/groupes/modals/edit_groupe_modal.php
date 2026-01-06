<!-- ================= MODAL EDIT GROUPE ================= -->
<div id="modalEditGroupe"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Modifier Groupe</h2>
            <button type="button" onclick="closeModal('modalEditGroupe')" class="text-gray-400">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="editGroupeForm" class="space-y-4">

            <input type="hidden" name="id_groupe" id="edit_id_groupe">

            <div>
                <label class="text-sm text-gray-600">Formation</label>
                <select name="id_formation" id="edit_id_formation" required
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">-- Choisir une formation --</option>
                    <?php foreach ($formations as $f): ?>
                        <option value="<?= $f['id_formation'] ?>">
                            <?= htmlspecialchars($f['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Nom (FR)</label>
                <input type="text" name="nom_fr" id="edit_nom_fr" required
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">Nom (AR)</label>
                <input type="text" name="nom_ar" id="edit_nom_ar"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">Effectif maximum</label>
                <input type="number" name="effectif_max" id="edit_effectif_max" min="1" required
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button"
                        onclick="closeModal('modalEditGroupe')"
                        class="px-4 py-2 border rounded-lg">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg">
                    Mettre à jour
                </button>
            </div>

        </form>
    </div>
</div>
