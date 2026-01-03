<div class="mb-6">

    <!-- Ligne 1 : Titre + bouton -->
    <div class="flex items-start justify-between mb-4 mt-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Prospects</h1>
            <p class="text-sm text-gray-500">
                Gérez vos prospects et convertissez-les en étudiants
            </p>
        </div>
<div class="flex items-center gap-3">
    <button onclick="openAddProspectModal()"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                   bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium">
        <i class="fa-solid fa-plus"></i>
        Nouveau Prospect
    </button>

    <?php if ($view === 'trash'): ?>
        <a href="prospects.php"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium">
            <i class="fa-solid fa-arrow-left"></i>
            Retour
        </a>
    <?php else: ?>
      <a href="prospects.php?view=trash"

           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  border border-gray-300 hover:bg-gray-100
                  text-gray-700 text-sm font-medium">
            <i class="fa-solid fa-trash"></i>
            Historique
        </a>
    <?php endif; ?>
</div>

    </div>