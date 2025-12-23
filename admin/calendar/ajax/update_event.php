<?php
require_once __DIR__ . '/../../../config.php';

/* =====================
   1. Vérification session (optionnel mais recommandé)
===================== */
if (!isset($_SESSION['user_id'])) {
    exit('Accès refusé');
}

/* =====================
   2. Validation des champs obligatoires
===================== */
$required = ['id_rdv', 'titre', 'type_rdv', 'date_rdv', 'heure_rdv', 'statut'];

foreach ($required as $field) {
    if (empty($_POST[$field])) {
        exit('Champs manquants');
    }
}

/* =====================
   3. Préparation requête UPDATE
===================== */
$sql = "
    UPDATE rendez_vous SET
        titre     = :titre,
        type_rdv  = :type_rdv,
        date_rdv  = :date_rdv,
        heure_rdv = :heure_rdv,
        statut    = :statut,
        notes     = :notes
    WHERE id_rdv = :id_rdv
";

$stmt = $pdo->prepare($sql);

/* =====================
   4. Exécution sécurisée
===================== */
$ok = $stmt->execute([
    ':titre'     => trim($_POST['titre']),
    ':type_rdv'  => $_POST['type_rdv'],
    ':date_rdv'  => $_POST['date_rdv'],
    ':heure_rdv' => $_POST['heure_rdv'],
    ':statut'    => $_POST['statut'],
    ':notes'     => $_POST['notes'] ?? null,
    ':id_rdv'    => (int) $_POST['id_rdv']
]);

if (!$ok) {
    exit('Erreur SQL');
}

echo 'success';
