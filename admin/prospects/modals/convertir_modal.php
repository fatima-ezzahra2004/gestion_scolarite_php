<div id="convertModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-lg">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Convertir le prospect</h2>
            <button onclick="closeConvertModal()"
                    class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Body -->
        <p class="text-sm text-gray-600 mb-6">
            Voulez-vous convertir
            <strong id="convertProspectName"></strong>
            en étudiant ?
        </p>

        <!-- Form -->
        <form method="POST" action="convertir_action.php" class="flex justify-end gap-3">
            <input type="hidden" name="id_prospect" id="convertProspectId">

            <button type="button"
                    onclick="closeConvertModal()"
                    class="px-4 py-2 border rounded-md text-sm">
                Annuler
            </button>

            <button type="submit"
                    class="px-4 py-2 bg-teal-600 hover:bg-teal-700
                           text-white rounded-md text-sm font-medium">
                Confirmer la conversion
            </button>
        </form>

    </div>
</div>
