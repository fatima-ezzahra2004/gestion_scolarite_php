<!-- ================= GRID ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">

<?php if (empty($prospects)): ?>
    <div class="col-span-full text-center text-gray-500 py-10">
        <?= $view === 'trash'
            ? 'Aucun prospect supprimé'
            : 'Aucun prospect trouvé'
        ?>
    </div>
<?php else: ?>

<?php foreach ($prospects as $p): ?>
<!-- CARD -->
<div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition ">

    <!-- TOP -->
    <div class="flex items-start gap-3">

        <!-- AVATAR -->
        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700
                    flex items-center justify-center font-semibold text-sm">
            <?= initiales(($p['prenom'] ?? '') . ' ' . ($p['nom'] ?? '')) ?>
        </div>

        <div class="flex-1">

            <div class="flex justify-between items-start">
                <div>
                    <!-- NOM -->
                    <h3 class="font-semibold text-gray-900 text-sm">
                        <?= htmlspecialchars(($p['prenom'] ?? '') . ' ' . ($p['nom'] ?? '')) ?>
                    </h3>

                    <!-- ÉTAT -->
                    <?php if ($view !== 'trash'): ?>
                        <span class="inline-block mt-1 px-2.5 py-0.5 text-xs rounded-full border
                              <?= filtreColor($p['etat'] ?? '') ?>">
                            <?= htmlspecialchars($p['etat'] ?? '-') ?>
                        </span>
                    <?php else: ?>
                        <span class="inline-block mt-1 px-2.5 py-0.5 text-xs rounded-full
                                     bg-red-100 text-red-700 border border-red-200">
                            Supprimé
                        </span>
                    <?php endif; ?>
                </div>

                <!-- MENU -->
                <div class="relative">
                    <button
                        type="button"
                        onclick="toggleMenu(<?= (int)$p['id_prospect'] ?>)"
                        class="text-gray-400 hover:text-teal-600">
                        <i class="fa-solid fa-ellipsis text-sm"></i>
                    </button>

                    <div
                        id="menu-<?= (int)$p['id_prospect'] ?>"
                        class="hidden absolute right-0 mt-2 w-48 bg-white
                               border rounded-xl shadow-lg text-sm z-35">

                        <?php if ($view === 'trash'): ?>
                            <!-- ===== MODE HISTORIQUE ===== -->
                            <button
    type="button"
    onclick="openRestoreModal(<?= (int)$p['id_prospect'] ?>)"
    class="block w-full text-left px-4 py-2
           text-green-600 hover:bg-green-50 rounded-xl">
    <i class="fa-solid fa-rotate-left text-xs mr-2"></i>
    Restaurer
</button>



                        <?php else: ?>
                            <!-- ===== MODE NORMAL ===== -->
                            <button
                                onclick="openDetails(<?= (int)$p['id_prospect'] ?>)"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                Voir détails
                            </button>

                            <button
                                onclick="openEdit(<?= (int)$p['id_prospect'] ?>)"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                Modifier
                            </button>

                            <a
                                href="../calendar/calendar.php"
                                class="block px-4 py-2 hover:bg-gray-100">
                                Planifier RDV
                            </a>

                            <button
                                type="button"
                                onclick="openConvertModal(
                                    <?= (int)$p['id_prospect'] ?>,
                                    '<?= htmlspecialchars($p['prenom'].' '.$p['nom'], ENT_QUOTES) ?>'
                                )"
                                class="flex items-center gap-2 px-4 py-2
                                       text-teal-600 hover:bg-teal-50 w-full text-left">
                                <i class="fa-solid fa-user-plus text-xs"></i>
                                Convertir en étudiant
                            </button>

                            <div class="border-t"></div>

                            <button
                                onclick="confirmDelete(<?= (int)$p['id_prospect'] ?>)"
                                class="block w-full text-left px-4 py-2
                                       text-red-600 hover:bg-red-50 rounded-b-xl">
                                Supprimer
                            </button>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- INFOS -->
            <div class="mt-2 space-y-1 text-sm text-gray-600">
                <p class="flex items-center gap-2">
                    <i class="fa-solid fa-phone text-teal-600 w-4 text-xs"></i>
                    <?= htmlspecialchars($p['telephone'] ?? '—') ?>
                </p>

                <p class="flex items-center gap-2">
                    <i class="fa-solid fa-envelope text-teal-600 w-4 text-xs"></i>
                    <?= htmlspecialchars($p['email'] ?? '—') ?>
                </p>

                <p class="flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-teal-600 w-4 text-xs"></i>
                    <?= htmlspecialchars($p['ville'] ?? '—') ?>
                </p>
            </div>

        </div>
    </div>

    <div class="border-t my-3"></div>

    <!-- BOTTOM -->
    <div class="flex justify-between items-center">
        <div class="flex gap-2">
            <span class="px-2.5 py-1 rounded-full text-xs bg-gray-100">
                <?= htmlspecialchars($p['canal'] ?? '—') ?>
            </span>

            <span class="px-2.5 py-1 rounded-full text-xs bg-gray-100">
                <?= htmlspecialchars($p['source'] ?? '—') ?>
            </span>
        </div>

        <?php if ($view !== 'trash'): ?>
            <button
                type="button"
                onclick="openConvertModal(
                    <?= (int)$p['id_prospect'] ?>,
                    '<?= htmlspecialchars($p['prenom'].' '.$p['nom'], ENT_QUOTES) ?>'
                )"
                class="inline-flex items-center gap-2 px-3 py-1.5
                       text-teal-600 hover:bg-teal-50 text-sm rounded-md">
                <i class="fa-solid fa-user-plus text-xs"></i>
                Convertir
            </button>
        <?php endif; ?>
    </div>

</div>
<!-- END CARD -->
<?php endforeach; ?>

<?php endif; ?>

</div>
