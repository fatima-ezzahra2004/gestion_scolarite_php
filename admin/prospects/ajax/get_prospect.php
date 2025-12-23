<?php
require_once __DIR__ . '/../../../config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    exit('<p class="text-red-600">ID invalide</p>');
}

$stmt = $pdo->prepare("
    SELECT p.*,
           t.nom AS tuteur_nom,
           t.prenom AS tuteur_prenom,
           t.telephone AS tuteur_tel
    FROM prospects p
    LEFT JOIN tuteurs t ON p.id_tuteur = t.id_tuteur
    WHERE p.id_prospect = ?
");
$stmt->execute([$_GET['id']]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) {
    exit('<p class="text-red-600">Prospect introuvable</p>');
}
?>
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4">

    <h3 class="text-sm font-semibold text-gray-700 mb-4">
        Informations personnelles
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

        <!-- Civilité -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Civilité</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['civilite'] ?? '-') ?>
            </p>
        </div>

        <!-- Genre -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Genre</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['genre'] ?? '-') ?>
            </p>
        </div>

        <!-- Nom -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Nom</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['nom']) ?>
            </p>
        </div>

        <!-- Prénom -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Prénom</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['prenom'] ?? '-') ?>
            </p>
        </div>

        <!-- Téléphone -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Téléphone</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['telephone'] ?? '-') ?>
            </p>
        </div>

        <!-- Email -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Email</p>
            <p class="font-medium text-gray-900 break-all">
                <?= htmlspecialchars($p['email'] ?? '-') ?>
            </p>
        </div>

        <!-- Adresse -->
        <div class="md:col-span-2">
            <p class="text-gray-500 text-xs mb-1">Adresse</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['adresse'] ?? '-') ?>
            </p>
        </div>

        <!-- Ville -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Ville</p>
            <p class="font-medium text-gray-900">
                <?= htmlspecialchars($p['ville'] ?? '-') ?>
            </p>
        </div>

        <!-- Date naissance -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Date de naissance</p>
            <p class="font-medium text-gray-900">
                <?= $p['date_naissance']
                    ? date('d/m/Y', strtotime($p['date_naissance']))
                    : '-' ?>
            </p>
        </div>

    </div>
</div>

<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-6">

    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
        <i class="fa-regular fa-user text-gray-500"></i>
        Parent / Tuteur
    </h3>

    <?php if (!empty($p['tuteur_nom'])): ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500 text-xs mb-1">Nom du tuteur</p>
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($p['tuteur_nom'] . ' ' . $p['tuteur_prenom']) ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500 text-xs mb-1">Téléphone</p>
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($p['tuteur_tel'] ?? '-') ?>
                </p>
            </div>

        </div>

    <?php else: ?>

        <p class="text-sm text-gray-500 italic">
            Aucun tuteur associé
        </p>

    <?php endif; ?>
</div>

