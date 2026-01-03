<!-- ================= GRID ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 pt-6">

<?php if (empty($formations)): ?>
    <div class="col-span-full text-center text-gray-500 py-10">
        <?= $view === 'trash'
            ? 'Aucune formation supprimée'
            : 'Aucune formation trouvée'
        ?>
    </div>
<?php endif; ?>


<?php foreach ($formations as $f): ?>
<div class="bg-white rounded-2xl border border-gray-200 p-6
            shadow-sm hover:shadow-md transition relative">

    <!-- HEADER -->
    <div class="flex justify-between items-start">

        <!-- BADGE TYPE -->
        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                     <?= filtreColor($f['type_formation']) ?>">
            <?= htmlspecialchars($f['type_formation']) ?>
        </span>
        

      <!-- MENU 3 POINTS -->
<div class="relative">
    <button
        type="button"
        onclick="toggleMenu(<?= (int)$f['id_formation'] ?>)"
        class="text-gray-400 hover:text-teal-600">
        <i class="fa-solid fa-ellipsis text-sm"></i>
    </button>

    <div
        id="menu-<?= (int)$f['id_formation'] ?>"
        class="hidden absolute right-0 mt-2 w-48 bg-white
               border rounded-xl shadow-lg text-sm z-50">

        <?php if ($view === 'trash'): ?>
            <!-- MODE HISTORIQUE -->
            <button
                type="button"
                onclick="openRestoreModal(<?= (int)$f['id_formation'] ?>)"
                class="block w-full text-left px-4 py-2
                       text-green-600 hover:bg-green-50 rounded-xl">
                <i class="fa-solid fa-rotate-left text-xs mr-2"></i>
                Restaurer
            </button>
        <?php else: ?>
            <!-- MODE NORMAL -->
          <button
    onclick="openDetailsFormation(<?= (int)$f['id_formation'] ?>)"
    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
    Voir détails
</button>


           <button
    onclick="openEditFormation(<?= (int)$f['id_formation'] ?>)"
    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
    Modifier
</button>


            <div class="border-t"></div>

            <button
                onclick="confirmDelete(<?= (int)$f['id_formation'] ?>)"
                class="block w-full text-left px-4 py-2
                       text-red-600 hover:bg-red-50 rounded-b-xl">
                Supprimer
            </button>
        <?php endif; ?>
    </div>
</div>

    </div>
    <h3 class="mt-4 text-base font-semibold text-gray-900">
        <?= htmlspecialchars($f['nom']) ?>
    </h3>

    <div class="flex items-center gap-2 text-sm text-gray-500 mt-2">
        <i class="fa-regular fa-calendar"></i>
        <?= htmlspecialchars($f['duree']) ?>
    </div>

    <div class="border-t my-5"></div>

    <!-- STATS (TOUCHER À RIEN) -->
    <div class="grid grid-cols-3 text-center gap-4">
        <div>
            <div class="flex justify-center items-center gap-1 text-blue-600 font-semibold text-sm">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <p class="text-xs text-gray-500 mt-1">Étudiants</p>
        </div>

        <div>
            <div class="flex justify-center items-center gap-1 text-emerald-600 font-semibold text-sm">
                <i class="fa-solid fa-book"></i>
            </div>
            <p class="text-xs text-gray-500 mt-1">Matières</p>
        </div>

        <div>
            <div class="flex justify-center items-center gap-1 text-orange-600 font-semibold text-sm">
                <i class="fa-solid fa-users"></i>
            </div>
            <p class="text-xs text-gray-500 mt-1">Groupes</p>
        </div>
    </div>
</div>
<?php endforeach; ?>

</div>
