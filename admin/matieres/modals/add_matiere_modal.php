<div id="addGroupeModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Ajouter un groupe</h2>
            <button onclick="closeAddGroupeModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="addGroupeForm">

            <div class="space-y-4">

                <!-- FORMATION -->
                <div>
                    <label class="text-sm text-gray-600">Formation</label>
                    <select name="id_formation" required
                            class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Choisir une formation --</option>
                        <?php foreach ($formations as $f): ?>
                            <option value="<?= $f['id_formation'] ?>">
                                <?= htmlspecialchars($f['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- NOM FR -->
                <div>
                    <label class="text-sm text-gray-600">Nom (FR)</label>
                    <input type="text" name="nom_fr" required
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- NOM AR -->
                <div>
                    <label class="text-sm text-gray-600">Nom (AR)</label>
                    <input type="text" name="nom_ar"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- EFFECTIF -->
                <div>
                    <label class="text-sm text-gray-600">Effectif maximum</label>
                    <input type="number" name="effectif_max" min="1" required
                           class="w-full border rounded-lg px-3 py-2">
                </div>

            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button
                    onclick="closeAddGroupeModal()"
                        class="px-4 py-2 border rounded-lg">
                    Annuler
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-teal-600 text-white rounded-lg">
                    Enregistrer
                </button>
            </div>

        </form>

    </div>
</div>
