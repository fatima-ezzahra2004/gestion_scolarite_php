<!-- HEADER -->
<div class="grid grid-cols-4 text-xs font-semibold text-gray-500 bg-gray-50 px-6 py-4">
    <div>ÉTUDIANT</div>
    <div>CONTACT ÉTUDIANT</div>
    <div>TUTEUR</div>
    <div></div>
</div>

<!-- ROWS -->
<?php foreach ($etudiants as $e): ?>
<div class="grid grid-cols-4 items-center px-6 py-4 border-t text-sm">

    <!-- ÉTUDIANT -->
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700
                    flex items-center justify-center font-semibold">
            <?= strtoupper($e['prenom'][0] . $e['nom'][0]) ?>
        </div>
        <div>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($e['prenom'].' '.$e['nom']) ?>
            </p>
            <p class="text-xs text-gray-500">
                <?= htmlspecialchars($e['ville'] ?? '-') ?>
            </p>
        </div>
    </div>

    <!-- CONTACT ÉTUDIANT -->
    <div class="text-gray-600 space-y-1 text-xs">
        <p><i class="fa-solid fa-phone mr-1"></i>
            <?= htmlspecialchars($e['telephone'] ?? '-') ?>
        </p>
        <p><i class="fa-solid fa-envelope mr-1"></i>
            <?= $e['email'] ? htmlspecialchars(substr($e['email'],0,22)).'…' : '-' ?>
        </p>
    </div>

    <!-- TUTEUR -->
    <div>
        <?php if ($e['tuteur_nom']): ?>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($e['tuteur_prenom'].' '.$e['tuteur_nom']) ?>
            </p>
            <p class="text-xs text-gray-500">
                <i class="fa-solid fa-phone mr-1"></i>
                <?= htmlspecialchars($e['tuteur_telephone'] ?? '-') ?>
            </p>
        <?php else: ?>
            <span class="text-xs text-gray-400 italic">
                Aucun tuteur
            </span>
        <?php endif; ?>
    </div>

   <!-- ACTIONS -->
<div class="flex justify-end">
    <div class="relative overflow-visible" data-menu-wrapper>

        <!-- 3 points -->
        <button onclick="toggleMenu(<?= $e['id_etudiant'] ?>)"
                class="p-2 rounded-full hover:bg-gray-100">
            <i class="fa-solid fa-ellipsis text-gray-500"></i>
        </button>

        <!-- MENU -->
        <div id="menu-<?= $e['id_etudiant'] ?>"
             class="hidden absolute right-0 mt-2 w-44
                    bg-white rounded-xl shadow-lg border
                    py-2 z-30">

                    <?php if ($view === 'trash'): ?>
            <!-- MODE HISTORIQUE -->
            <button
                type="button"
                onclick="openRestoreEtudiantModal(<?= (int)$e['id_etudiant'] ?>)"
                class="block w-full text-left px-4 py-2
                       text-green-600 hover:bg-green-50 rounded-xl">
                <i class="fa-solid fa-rotate-left text-xs mr-2"></i>
                Restaurer
            </button>
        <?php else: ?>
            <!-- MODE NORMAL -->
          <button onclick="openDetailsEtudiant(<?= $e['id_etudiant'] ?>)"
                    class="w-full text-left px-4 py-2
                           text-sm text-gray-700
                           hover:bg-gray-100 rounded-md">
                Voir profil
            </button>

            <button onclick="openEditEtudiant(<?= $e['id_etudiant'] ?>)"
                    class="w-full text-left px-4 py-2
                           text-sm text-gray-700
                           hover:bg-gray-100 rounded-md">
                Modifier
            </button>


            <div class="border-t"></div>

             <div class="px-3 pt-2">
                <button onclick="openDeleteEtudiant(<?= $e['id_etudiant'] ?>)"
                        class="w-full text-sm font-medium
                               bg-red-400 hover:bg-red-500
                               text-white rounded-lg
                               py-2 transition">
                    Supprimer
                </button>
            </div>

        <?php endif; ?>

        </div>
    </div>
</div>

</div>
<?php endforeach; ?>

</div>