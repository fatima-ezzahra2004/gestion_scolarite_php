<div id="modalDelete"
     class="hidden fixed inset-0 bg-black/40 items-center justify-center z-50">

    <div class="bg-white rounded-xl w-[400px] p-6">
        <h2 class="text-lg font-semibold mb-3">Confirmation</h2>

        <p class="text-sm text-gray-600 mb-4">
            Voulez-vous vraiment supprimer ce prospect ?
        </p>

        <div class="flex justify-end gap-3">
            <button
                type="button"
                onclick="closeModals('modalDelete')"
                class="px-4 py-2 border rounded">
                Annuler
            </button>

            <button
                id="btnDeleteConfirm"
                type="button"
                class="px-4 py-2 bg-red-600 text-white rounded">
                Supprimer
            </button>
        </div>
    </div>
</div>
