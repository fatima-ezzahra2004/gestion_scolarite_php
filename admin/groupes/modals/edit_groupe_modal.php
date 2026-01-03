
<div id="modalEditFormation"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-xl p-6">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Modifier formation</h2>
            <button onclick="closeModal('modalEditFormation')" class="text-gray-400">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="POST" action="ajax/update_formation.php" class="space-y-4">

    <input type="hidden" name="id" id="edit_id">

    <div>
        <label class="text-sm text-gray-600">Nom</label>
        <input id="edit_nom" name="nom" required
               class="w-full border rounded-lg px-3 py-2">
    </div>

    <div>
        <label class="text-sm text-gray-600">Type</label>
        <select id="edit_type" name="type_formation" required
                class="w-full border rounded-lg px-3 py-2">
            <option value="Préscolaire">Préscolaire</option>
            <option value="Primaire">Primaire</option>
            <option value="Collège">Collège</option>
            <option value="Lycée">Lycée</option>
            <option value="Enseignement supérieur">Enseignement supérieur</option>
            <option value="Professionnelle">Professionnelle</option>
            <option value="Licence">Licence</option>
            <option value="Master">Master</option>
            <option value="Certificat">Certificat</option>
            <option value="Formation continue">Formation continue</option>
        </select>
    </div>

    <div>
        <label class="text-sm text-gray-600">Duree</label>
        <input type="date" id="edit_duree" name="date_debut" required
               class="w-full border rounded-lg px-3 py-2">
    </div>


    <div class="flex justify-end gap-3 pt-4">
        <button type="button"
                onclick="closeModal('modalEditFormation')"
                class="px-4 py-2 border rounded-lg">
            Annuler
        </button>
        <button class="px-4 py-2 bg-teal-600 text-white rounded-lg">
            Mettre à jour
        </button>
    </div>

</form>

    </div>
</div>
