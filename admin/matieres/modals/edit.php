<div id="editMatiereModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-lg p-6 shadow-lg">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-gray-800">Modifier la matière</h2>
            <button onclick="closeEditMatiereModal()">
                <i class="fa-solid fa-xmark text-gray-500 hover:text-gray-700"></i>
            </button>
        </div>

        <form id="editMatiereForm" class="space-y-4">
            <input type="hidden" name="id_matiere" id="edit_id_matiere">
            <div>
                <label class="text-sm text-gray-600">Nom (FR)</label>
                <input type="text" name="nom_fr" id="edit_nom_fr" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="text-sm text-gray-600">Nom (AR)</label>
                <input type="text" name="nom_ar" id="edit_nom_ar" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="text-sm text-gray-600">Description</label>
                <textarea name="description" id="edit_description" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeEditMatiereModal()" class="px-4 py-2 border rounded-lg">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
