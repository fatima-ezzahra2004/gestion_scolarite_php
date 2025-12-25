
<div id="modalDelete" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <h2 class="text-lg font-semibold text-red-600 mb-3">
            Supprimer étudiant
        </h2>

        <p class="text-sm text-gray-600">
            Cette action est irréversible.
        </p>

        <div class="flex justify-end gap-3 mt-5">
            <button onclick="closeModal('modalDelete')"
                    class="px-4 py-2 bg-gray-200 rounded">
                Annuler
            </button>

            <form method="POST" action="actions/delete_etudiant.php">
                <input type="hidden" name="id_etudiant" id="deleteId">
                <button class="px-4 py-2 bg-red-600 text-white rounded">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
