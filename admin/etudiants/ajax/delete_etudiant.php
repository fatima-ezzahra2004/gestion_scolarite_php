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

    // 🔎 récupérer le tuteur lié
    $stmt = $pdo->prepare("
        SELECT id_tuteur
        FROM etudiants
        WHERE id_etudiant = ?
    ");
    $stmt->execute([$id]);
    $id_tuteur = $stmt->fetchColumn();

    // ❌ soft delete étudiant
    $pdo->prepare("
        UPDATE etudiants
        SET deleted_at = NOW()
        WHERE id_etudiant = ?
    ")->execute([$id]);

    // ❌ soft delete tuteur (s'il existe)
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
