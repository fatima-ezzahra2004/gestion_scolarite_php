<div class="bg-white rounded-xl border border-gray-200 overflow-hidden mt-6">

<table class="w-full text-sm">
    <thead class="bg-gray-50 text-gray-600">
        <tr>
            <th class="px-6 py-4 text-left">Nom</th>
            <th class="px-6 py-4 text-left">Formation</th>
            <th class="px-6 py-4 text-left">Capacité</th>
            <th class="px-6 py-4 text-right">Actions</th>
        </tr>
    </thead>

    <tbody class="divide-y">
    <?php foreach ($groupes as $g): 
        $pourcentage = ($g['effectif_actuel'] / $g['effectif_max']) * 100;
    ?>
        <tr class="hover:bg-gray-50 relative">

            <!-- NOM -->
            <td class="px-6 py-4">
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($g['nom_fr']) ?>
                </p>
                <p class="text-xs text-gray-500">
                    <?= htmlspecialchars($g['nom_ar']) ?>
                </p>
            </td>

            <!-- FORMATION -->
            <td class="px-6 py-4 text-gray-700">
                <?= htmlspecialchars($g['formation_nom']) ?>
            </td>

            <!-- CAPACITÉ -->
            <td class="px-6 py-4">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-users text-gray-400"></i>
                    <span class="text-orange-600 font-medium">
                        <?= $g['effectif_actuel'] ?>
                    </span>
                    <span class="text-gray-400">
                        / <?= $g['effectif_max'] ?>
                    </span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                    <div
                        class="bg-blue-600 h-2 rounded-full"
                        style="width: <?= $pourcentage ?>%">
                    </div>
                </div>
            </td>

            <!-- ACTIONS : MENU 3 POINTS -->
            <td class="px-6 py-4 text-right">
                <div class="relative inline-block">

                    <button
                        type="button"
                        onclick="toggleMenu(<?= (int)$g['id_groupe'] ?>)"
                        class="text-gray-400 hover:text-teal-600">
                        <i class="fa-solid fa-ellipsis text-sm"></i>
                    </button>

                    <div
                        id="menu-<?= (int)$g['id_groupe'] ?>"
                        class="hidden absolute right-0 mt-2 w-48 bg-white
                               border rounded-xl shadow-lg text-sm z-50">

                        <?php if ($view === 'trash'): ?>
                            <!-- MODE HISTORIQUE -->
                            <button
                                type="button"
                                onclick="openRestoreGroupe(<?= (int)$g['id_groupe'] ?>)"
                                class="block w-full text-left px-4 py-2
                                       text-green-600 hover:bg-green-50 rounded-xl">
                                <i class="fa-solid fa-rotate-left text-xs mr-2"></i>
                                Restaurer
                            </button>
                        <?php else: ?>
                            <!-- MODE NORMAL -->
                            <button
                                onclick="openDetailsGroupe(<?= (int)$g['id_groupe'] ?>)"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                Voir détails
                            </button>

                            <button
                                onclick="openEditGroupe(<?= (int)$g['id_groupe'] ?>)"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                Modifier
                            </button>

                            <div class="border-t"></div>

                            <button
                                onclick="confirmDeleteGroupe(<?= (int)$g['id_groupe'] ?>)"
                                class="block w-full text-left px-4 py-2
                                       text-red-600 hover:bg-red-50 rounded-b-xl">
                                Supprimer
                            </button>
                        <?php endif; ?>
                    </div>

                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
