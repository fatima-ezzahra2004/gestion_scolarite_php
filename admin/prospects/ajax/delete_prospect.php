<?php
require_once __DIR__ . '/../../../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(400);
    exit;
}

$pdo->beginTransaction();

try {

    /* ===============================
       1️⃣ RÉCUPÉRER LE TUTEUR LIÉ
    ================================ */
    $stmt = $pdo->prepare("
        SELECT id_tuteur
        FROM prospects
        WHERE id_prospect = ?
    ");
    $stmt->execute([$id]);
    $id_tuteur = $stmt->fetchColumn();

    /* ===============================
       2️⃣ SOFT DELETE PROSPECT
    ================================ */
    $pdo->prepare("
        UPDATE prospects
        SET deleted_at = NOW()
        WHERE id_prospect = ?
    ")->execute([$id]);

    /* ===============================
       3️⃣ SOFT DELETE TUTEUR (SI EXISTE)
    ================================ */
    if ($id_tuteur) {
        $pdo->prepare("
            UPDATE tuteurs
            SET deleted_at = NOW()
            WHERE id_tuteur = ?
        ")->execute([$id_tuteur]);
    }

    $pdo->commit();

    // ✅ succès silencieux (AJAX)
    http_response_code(204);
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    exit;
}
