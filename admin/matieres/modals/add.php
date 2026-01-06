<!-- Bouton pour ouvrir le modal -->
<div class="flex items-center gap-3 mb-4">
    <button onclick="openAddMatiereModal()"
        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
               bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium">
        <i class="fa-solid fa-plus"></i>
        Nouvelle Matière
    </button>
</div>

<!-- MODAL CENTRÉ -->
<div id="addMatiereModal"
     class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center">

    <!-- Card du modal -->
    <div class="bg-white rounded-xl w-full max-w-lg p-6 shadow-lg">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-gray-800">Ajouter une matière</h2>
            <button onclick="closeAddMatiereModal()">
                <i class="fa-solid fa-xmark text-gray-500 hover:text-gray-700"></i>
            </button>
        </div>

        <!-- Formulaire -->
        <form id="addMatiereForm" class="space-y-4">

            <div>
                <label class="text-sm text-gray-600">Nom (FR)</label>
                <input type="text" name="nom_fr" required
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">Nom (AR)</label>
                <input type="text" name="nom_ar"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button"
                        onclick="closeAddMatiereModal()"
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
