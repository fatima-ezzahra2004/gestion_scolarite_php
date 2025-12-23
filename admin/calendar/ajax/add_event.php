<?php
require_once __DIR__ . '/../../../config.php';

$typesAutorises = ['Demande d information', 'Consultation'];
$statutsAutorises = ['planifié', 'traité', 'annulé'];

$id_prospect = $_POST['id_prospect'] ?? null;
$id_employe  = $_POST['id_employe'] ?? null;
$type_rdv    = $_POST['type_rdv'] ?? '';
$statut      = $_POST['statut'] ?? 'planifié';

if (!$id_prospect || !$id_employe) {
    exit('Prospect et employé obligatoires');
}

if (!in_array($type_rdv, $typesAutorises)) {
    exit('Type de rendez-vous invalide');
}

if (!in_array($statut, $statutsAutorises)) {
    exit('Statut invalide');
}

$stmt = $pdo->prepare("
    INSERT INTO rendez_vous
    (id_prospect, id_employe, titre, type_rdv, date_rdv, heure_rdv, statut, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $id_prospect,
    $id_employe,
    $_POST['titre'],
    $type_rdv,
    $_POST['date_rdv'],
    $_POST['heure_rdv'],
    $statut,
    $_POST['notes'] ?? null
]);

echo 'success';
