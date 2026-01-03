<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mt-6">

<table class="w-full text-sm">
    <thead class="bg-gray-50 text-gray-600">
        <tr>
            <th class="px-6 py-4 text-left">Matière</th>
            <th class="px-6 py-4 text-left">Description</th>
            <th class="px-6 py-4 text-center">Formations</th>
            <th class="px-6 py-4 text-center">Statut</th>
            <th class="px-6 py-4 text-right">Actions</th>
        </tr>
    </thead>

    <tbody class="divide-y">
    <?php foreach ($matieres as $m): ?>
        <tr class="hover:bg-gray-50">

            <!-- MATIÈRE -->
            <td class="px-6 py-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fa-solid fa-book text-blue-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">
                        <?= htmlspecialchars($m['nom_fr']) ?>
                    </p>
                    <p class="text-xs text-gray-500">
                        <?= htmlspecialchars($m['nom_ar']) ?>
                    </p>
                </div>
            </td>

            <!-- DESCRIPTION -->
            <td class="px-6 py-4 text-gray-600">
                <?= htmlspecialchars($m['description']) ?>
            </td>

            <td class="px-6 py-4 text-center">
    <button
        onclick="openFormationsModal(
            <?= (int)$m['id_matiere'] ?>,
            '<?= htmlspecialchars($m['nom_fr'], ENT_QUOTES) ?>'
        )"
        class="inline-flex items-center gap-2 px-3 py-1.5
               border rounded-lg text-sm hover:bg-gray-50">

        <i class="fa-solid fa-link text-gray-500"></i>

        <span class="bg-gray-100 px-2 py-0.5 rounded-full text-xs">
            <?= (int)$m['nb_formations'] ?>
        </span>

        <span>Voir les formations</span>
    </button>
</td>

            <!-- STATUT -->
            <td class="px-6 py-4 text-center">
                <label class="inline-flex items-center cursor-pointer">
                    <input
                        type="checkbox"
                        class="sr-only peer"
                        <?= $m['statut'] ? 'checked' : '' ?>
                        onchange="toggleMatiereStatus(<?= (int)$m['id_matiere'] ?>)"
                    >
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer
                                peer-checked:bg-blue-600
                                after:content-['']
                                after:absolute after:top-0.5 after:left-0.5
                                after:bg-white after:rounded-full after:h-5 after:w-5
                                after:transition-all
                                peer-checked:after:translate-x-full">
                    </div>
                </label>
            </td>

            <!-- ACTIONS -->
            <td class="px-6 py-4 text-right">
                <div class="relative inline-block">
                    <button
                        onclick="toggleMenu(<?= (int)$m['id_matiere'] ?>)"
                        class="text-gray-400 hover:text-blue-600">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>

                    <div
                        id="menu-<?= (int)$m['id_matiere'] ?>"
                        class="hidden absolute right-0 mt-2 w-44 bg-white
                               border rounded-xl shadow-lg text-sm z-50">

                        <button
                            onclick="openEditMatiere(<?= (int)$m['id_matiere'] ?>)"
                            class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                            Modifier
                        </button>

                        <div class="border-t"></div>

                        <button
                            onclick="confirmDeleteMatiere(<?= (int)$m['id_matiere'] ?>)"
                            class="block w-full text-left px-4 py-2
                                   text-red-600 hover:bg-red-50 rounded-b-xl">
                            Supprimer
                        </button>
                    </div>
                </div>
            </td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
