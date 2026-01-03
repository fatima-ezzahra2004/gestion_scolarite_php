<div id="modalRestore"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-sm p-6 text-center">

        <i class="fa-solid fa-rotate-left text-green-600 text-3xl mb-3"></i>

        <h3 class="font-semibold text-gray-900">
            Restaurer la formation
        </h3>

        <p class="text-sm text-gray-500 mt-2">
            La formation sera de nouveau active.
        </p>

        <div class="flex justify-center gap-3 mt-6">
            <button onclick="closeModal('modalRestore')"
                    class="px-4 py-2 border rounded-lg">
                Annuler
            </button>

            <button id="btnRestoreConfirm"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg">
                Restaurer
            </button>
        </div>

    </div>
</div>
