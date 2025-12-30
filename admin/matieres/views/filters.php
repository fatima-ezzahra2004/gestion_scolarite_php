<?php 
$recherche = $_GET['recherche'] ?? '';

$sql = "SELECT * FROM matieres WHERE 
        nom_fr LIKE :recherche OR 
        nom_ar LIKE :recherche OR 
        description LIKE :recherche 
        ORDER BY nom_fr";
$stmt = $pdo->prepare($sql);
$stmt->execute(['recherche' => "%$recherche%"]);
$matieres = $stmt->fetchAll();
?>

<div class="p-6">

    <div class="flex flex-col md:flex-row justify-between items-center gap-3">

        <!-- Recherche + boutons -->
        <form method="GET" class="flex flex-1 gap-2 w-full">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass
                      absolute left-3 top-1/2 -translate-y-1/2
                      text-gray-400 text-base"></i>

                <input type="text"
                       name="recherche"
                       value="<?= htmlspecialchars($recherche) ?>"
                       placeholder="Rechercher par Nom FR, Nom AR ou Description..."
                       class="w-full pl-10 pr-3 py-1.5 text-base rounded-md
                              border border-gray-300
                              focus:outline-none focus:ring-2 focus:ring-sky-400">
            </div>

            <button type="submit"
                    class="px-3 py-1.5 rounded-md bg-sky-500 hover:bg-sky-600
                           text-white text-base font-medium flex items-center gap-1">
                <i class="fa-solid fa-magnifying-glass"></i>
                Rechercher
            </button>

            <!-- Bouton Reset -->
            <a href="<?= $_SERVER['PHP_SELF'] ?>" 
               class="px-3 py-1.5 rounded-md bg-gray-400 hover:bg-gray-500
                      text-white text-base font-medium flex items-center gap-1">
                <i class="fa-solid fa-rotate-left"></i>
                Reset
            </a>
        </form>

    </div>

</div>
