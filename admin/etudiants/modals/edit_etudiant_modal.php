<div id="modalEdit" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-xl p-6">
        <h2 class="text-lg font-semibold mb-4">Modifier étudiant</h2>

        <form method="POST" action="actions/update_etudiant.php">
            <input type="hidden" name="id_etudiant" id="editId">

            <!-- champs -->
            <input type="text" name="prenom" class="w-full border rounded px-3 py-2 mb-3">

            <div class="text-right">
                <button type="button"
                        onclick="closeModal('modalEdit')"
                        class="px-4 py-2 bg-gray-200 rounded">
                    Annuler
                </button>
                <button class="px-4 py-2 bg-teal-600 text-white rounded">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
