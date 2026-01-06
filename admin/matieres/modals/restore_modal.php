<!-- MODAL RESTORE MATIERE -->
<div id="restoreMatiereModal" class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-lg">
        <h2 class="text-lg font-semibold mb-4">Restaurer Matière</h2>
        <p class="text-sm text-gray-600 mb-6">Voulez-vous vraiment restaurer cette matière ?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeRestoreMatiere()" class="px-4 py-2 border rounded-md">Annuler</button>
            <button onclick="confirmRestoreMatiere()" class="px-4 py-2 bg-green-600 text-white rounded-md">Restaurer</button>
        </div>
    </div>
</div>
