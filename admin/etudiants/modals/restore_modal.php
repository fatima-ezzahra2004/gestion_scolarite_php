<!-- ================= MODAL RESTAURER ETUDIANT ================= -->
<div id="restoreEtudiantModal"
     class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-lg">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-900">
                Restaurer l’étudiant
            </h2>
            <button onclick="closeRestoreEtudiantModal()"
                    class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Body -->
        <p class="text-sm text-gray-600 mb-6">
            Voulez-vous vraiment restaurer cet étudiant ?
            <br>
            <span class="text-xs text-gray-400">
                (Le parent / tuteur sera aussi restauré)
            </span>
        </p>

        <!-- Footer -->
        <div class="flex justify-end gap-3">
            <button
                type="button"
                onclick="closeRestoreEtudiantModal()"
                class="px-4 py-2 border rounded-md text-sm hover:bg-gray-50">
                Annuler
            </button>

            <button
                type="button"
                onclick="confirmRestoreEtudiant()"
                class="px-4 py-2 bg-green-600 hover:bg-green-700
                       text-white rounded-md text-sm font-medium">
                Restaurer
            </button>
        </div>

    </div>
</div>
