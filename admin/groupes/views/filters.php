<?php
require_once '../../config.php';

// Récupérer la valeur de recherche
$recherche = $_GET['recherche'] ?? '';

// Requête SQL avec filtre
$sql = "SELECT g.*, f.nom AS formation_nom
        FROM groupes g
        LEFT JOIN formations f ON f.id_formation = g.id_formation
        WHERE g.nom_fr LIKE :recherche
           OR g.nom_ar LIKE :recherche
           OR f.nom LIKE :recherche
        ORDER BY f.nom, g.nom_fr";

$stmt = $pdo->prepare($sql);
$stmt->execute(['recherche' => "%$recherche%"]);
$groupes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="flex flex-wrap gap-3 mb-6">
    <!-- Formulaire de recherche -->
    <form method="GET" class="flex gap-2 flex-1 min-w-[280px]">

        <!-- Input avec icône -->
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

        <!-- Si on est dans la vue "trash" -->
        <?php if (!empty($view) && $view === 'trash'): ?>
            <input type="hidden" name="view" value="trash">
        <?php endif; ?>

        <!-- Bouton recherche -->
        <button type="submit"
                class="px-4 py-2 rounded-lg bg-sky-500 hover:bg-sky-600
                       text-white text-sm font-medium flex items-center gap-2">
            <i class="fa-solid fa-magnifying-glass"></i>
            Rechercher
        </button>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" 
               class="px-3 py-1.5 rounded-md bg-gray-400 hover:bg-gray-500
                      text-white text-base font-medium flex items-center gap-1">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
            </a>

    </form>
</div>
