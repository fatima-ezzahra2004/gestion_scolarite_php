<div id="addFormationModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Ajouter une formation</h2>
            <button onclick="closeModal('addFormationModal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="addFormationForm">

            <div class="space-y-4">

                <div>
                    <label class="text-sm text-gray-600">Type</label>
                    <select name="type_formation" required
        class="w-full border rounded-lg px-3 py-2">
    <option value="">-- Choisir --</option>

    <option value="Licence">Licence</option>
    <option value="Master">Master</option>
    <option value="Certificat">Téchnicien Spécialisé</option>
    <option value="Formation continue">Formation</option>
</select>
            </div>

                <div>
                    <label class="text-sm text-gray-600">Nom</label>
                    <input type="text" name="nom" required
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Duree</label>
                        <input type="text" name="duree" required
                               class="w-full border rounded-lg px-3 py-2">
                    </div>

            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button type="button"
                        onclick="closeModal('addFormationModal')"
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
