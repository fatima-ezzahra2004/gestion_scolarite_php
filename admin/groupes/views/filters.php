
    <!-- Ligne 2 : Recherche + filtre -->
    <div class="flex flex-wrap gap-3">
<!-- Recherche -->
<form method="GET" class="flex gap-2 flex-1 min-w-[280px]">

    <div class="relative flex-1">
        <i class="fa-solid fa-magnifying-glass
                  absolute left-3 top-1/2 -translate-y-1/2
                  text-gray-400 text-sm"></i>

      <input type="text"
       name="recherche"
       value="<?= htmlspecialchars($recherche) ?>"
       placeholder="Rechercher par nom, prénom, genre, canal ou source..."
       class="w-full pl-9 pr-3 py-2 rounded-lg
              border border-gray-300 text-sm
              focus:outline-none focus:ring-2 focus:ring-sky-400">

    </div>
<?php if ($view === 'trash'): ?>
        <input type="hidden" name="view" value="trash">
    <?php endif; ?>
    <button type="submit"
            class="px-4 py-2 rounded-lg bg-sky-500 hover:bg-sky-600
                   text-white text-sm font-medium flex items-center gap-2">
        <i class="fa-solid fa-magnifying-glass"></i>
        Rechercher
    </button>

</form>



    </div>



