<div id="modalArchive" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <h2 class="text-lg font-semibold mb-3">Archiver étudiant</h2>

        <p class="text-sm text-gray-600">
            L’étudiant sera masqué mais récupérable.
        </p>

        <div class="flex justify-end gap-3 mt-5">
            <button onclick="closeModal('modalArchive')"
                    class="px-4 py-2 bg-gray-200 rounded">
                Annuler
            </button>

            <form method="POST" action="actions/archive_etudiant.php">
                <input type="hidden" name="id_etudiant" id="archiveId">
                <button class="px-4 py-2 bg-yellow-500 text-white rounded">
                    Archiver
                </button>
            </form>
        </div>
    </div>
</div>
