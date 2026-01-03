<?php
require_once '../../../config.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT
        -- ETUDIANT
        e.id_etudiant,
        e.niveau_etude,
        e.created_at,

        -- DOCUMENTS
        e.pdf_cin,
        e.pdf_profil,
        e.diplome_scan,

        -- USER (identité)
        u.nom,
        u.prenom,
        u.cin,
        u.telephone,
        u.email,
        u.ville,
        u.adresse,
        u.date_naissance,

        -- TUTEUR
        t.nom        AS tuteur_nom,
        t.prenom     AS tuteur_prenom,
        t.telephone  AS tuteur_telephone,
        t.lien_parente

    FROM etudiants e
    INNER JOIN users u ON u.id = e.user_id
    LEFT JOIN tuteurs t ON t.id_tuteur = e.id_tuteur
    WHERE e.id_etudiant = :id
    LIMIT 1
");


$stmt->execute(['id' => $id]);
$e = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$e) {
    echo '<p class="text-red-500">Étudiant introuvable</p>';
    exit;
}
?>


<div class="grid grid-cols-2 gap-4">

    <!-- NOM -->
    <div>
        <span class="text-gray-500 text-xs">Nom</span>
        <p class="font-medium"><?= htmlspecialchars($e['nom']) ?></p>
    </div>

    <!-- PRENOM -->
    <div>
        <span class="text-gray-500 text-xs">Prénom</span>
        <p class="font-medium"><?= htmlspecialchars($e['prenom']) ?></p>
    </div>

    <!-- CIN -->
    <div>
        <span class="text-gray-500 text-xs">CIN</span>
        <p class="font-medium"><?= htmlspecialchars($e['cin'] ?? '-') ?></p>
    </div>

    <!-- TELEPHONE -->
    <div>
        <span class="text-gray-500 text-xs">Téléphone</span>
        <p class="font-medium"><?= htmlspecialchars($e['telephone'] ?? '-') ?></p>
    </div>

    <!-- EMAIL -->
    <div>
        <span class="text-gray-500 text-xs">Email</span>
        <p class="font-medium"><?= htmlspecialchars($e['email'] ?? '-') ?></p>
    </div>

    <!-- VILLE -->
    <div>
        <span class="text-gray-500 text-xs">Ville</span>
        <p class="font-medium"><?= htmlspecialchars($e['ville'] ?? '-') ?></p>
    </div>

    <!-- ADRESSE -->
    <div class="col-span-2">
        <span class="text-gray-500 text-xs">Adresse</span>
        <p class="font-medium"><?= htmlspecialchars($e['adresse'] ?? '-') ?></p>
    </div>

    <!-- DATE NAISSANCE -->
    <div>
        <span class="text-gray-500 text-xs">Date de naissance</span>
        <p class="font-medium">
            <?= !empty($e['date_naissance'])
                ? date('d/m/Y', strtotime($e['date_naissance']))
                : '-' ?>
        </p>
    </div>

    <!-- CREATED AT -->
    <div>
        <span class="text-gray-500 text-xs">Créé le</span>
        <p class="font-medium">
            <?= !empty($e['created_at'])
                ? date('d/m/Y H:i', strtotime($e['created_at']))
                : '-' ?>
        </p>
    </div>
    <!-- NIVEAU D’ÉTUDE --><div>
    <span class="text-gray-500 text-xs">Niveau d’étude</span>
    <p class="font-medium">
        <?= htmlspecialchars($e['niveau_etude'] ?? '-') ?>
    </p>
</div>

<!-- DOCUMENTS -->
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-6 col-span-2">

    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
        <i class="fa-regular fa-file-pdf text-gray-500"></i>
        Documents
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">

        <!-- CIN -->
        <div>
            <p class="text-gray-500 text-xs mb-1">CIN</p>
            <?php if (!empty($e['pdf_cin'])): ?>
                <a href="<?= htmlspecialchars($e['pdf_cin']) ?>"
                   target="_blank"
                   class="text-sky-600 hover:underline font-medium">
                    Voir le document
                </a>
            <?php else: ?>
                <span class="italic text-gray-400">Non fourni</span>
            <?php endif; ?>
        </div>

        <!-- PROFIL -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Photo de profil</p>
            <?php if (!empty($e['pdf_profil'])): ?>
                <a href="<?= htmlspecialchars($e['pdf_profil']) ?>"
                   target="_blank"
                   class="text-sky-600 hover:underline font-medium">
                    Voir le document
                </a>
            <?php else: ?>
                <span class="italic text-gray-400">Non fournie</span>
            <?php endif; ?>
        </div>

        <!-- DIPLÔME -->
        <div>
            <p class="text-gray-500 text-xs mb-1">Diplôme</p>
            <?php if (!empty($e['diplome_scan'])): ?>
                <a href="<?= htmlspecialchars($e['diplome_scan']) ?>"
                   target="_blank"
                   class="text-sky-600 hover:underline font-medium">
                    Voir le document
                </a>
            <?php else: ?>
                <span class="italic text-gray-400">Non fourni</span>
            <?php endif; ?>
        </div>

    </div>
</div>


   <!-- TUTEUR -->
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-6 col-span-2">

    <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
        <i class="fa-regular fa-user text-gray-500"></i>
        Parent / Tuteur
    </h3>

    <?php if (!empty($e['tuteur_nom'])): ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">

            <div>
                <p class="text-gray-500 text-xs mb-1">Lien de parenté</p>
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($e['lien_parente'] ?? '-') ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500 text-xs mb-1">Nom du tuteur</p>
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($e['tuteur_prenom'].' '.$e['tuteur_nom']) ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500 text-xs mb-1">Téléphone</p>
                <p class="font-medium text-gray-900">
                    <?= htmlspecialchars($e['tuteur_telephone'] ?? '-') ?>
                </p>
            </div>

        </div>

    <?php else: ?>

        <p class="text-sm text-gray-500 italic">
            Aucun tuteur associé
        </p>

    <?php endif; ?>

</div>
