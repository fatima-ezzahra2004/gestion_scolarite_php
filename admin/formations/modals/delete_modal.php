<div id="modalDelete"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-sm p-6 text-center">

        <i class="fa-solid fa-triangle-exclamation text-red-500 text-3xl mb-3"></i>

        <h3 class="font-semibold text-gray-900">
            Confirmer la suppression
        </h3>

        <p class="text-sm text-gray-500 mt-2">
            Cette action est réversible.
        </p>

        <div class="flex justify-center gap-3 mt-6">
            <button onclick="closeModal('modalDelete')"
                    class="px-4 py-2 border rounded-lg">
                Annuler
            </button>

            <button id="btnDeleteConfirm"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">
                Supprimer
            </button>
        </div>

    </div>
</div>
