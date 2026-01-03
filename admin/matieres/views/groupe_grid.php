<div class="p-6">





            <table class="w-full border bg-white rounded shadow">
                <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">Nom (FR)</th>
                    <th class="p-3 border">Nom (AR)</th>
                    <th class="p-3 border">description</th>
                    <th class="p-3 border">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($matieres as $m): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border"><?= htmlspecialchars($m['nom_fr']) ?></td>
                        <td class="p-3 border"><?= htmlspecialchars($m['nom_ar']) ?></td>
                        <td class="p-3 border"><?= htmlspecialchars($m['description']) ?></td>
                        <td class="p-3 border text-center">
                            <button onclick="editMatiere(<?= $m['id_matiere'] ?>)"
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button onclick="deleteMatiere(<?= $m['id_matiere'] ?>)"
                                    class="text-red-600 hover:text-red-900">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </main>
</div>

<!-- MODAL -->
<div id="modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span id="close">&times;</span>
        <div id="modalBody"></div>
    </div>
</div>
