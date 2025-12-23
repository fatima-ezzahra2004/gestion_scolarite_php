<?php
require_once __DIR__ . '/../../../config.php';

/* =====================
   1. Vérification session
===================== */
if (!isset($_SESSION['user_id'])) {
    exit('Accès refusé');
}

/* =====================
   2. Vérification ID
===================== */
if (empty($_POST['id_rdv'])) {
    exit('ID manquant');
}

$id = (int) $_POST['id_rdv'];

/* =====================
   3. Suppression sécurisée
===================== */
$stmt = $pdo->prepare("DELETE FROM rendez_vous WHERE id_rdv = ?");
$ok = $stmt->execute([$id]);

if (!$ok) {
    exit('Erreur SQL');
}

echo 'success';
