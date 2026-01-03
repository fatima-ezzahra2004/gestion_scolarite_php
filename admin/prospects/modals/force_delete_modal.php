<!-- ================= MODAL FORCE DELETE ================= -->
<div id="modalForceDelete"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6">

        <h2 class="text-lg font-semibold text-red-700 mb-3">
            Suppression définitive
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            ⚠️ Cette action est <strong>irréversible</strong>.
            Le prospect sera supprimé définitivement de la base de données.
        </p>

        <div class="flex justify-end gap-3">
            <button
                type="button"
                onclick="closeForceDeleteModal()"
                class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                Annuler
            </button>

            <button
                type="button"
                onclick="confirmForceDelete()"
                class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Supprimer définitivement
            </button>
        </div>

    </div>
</div>
