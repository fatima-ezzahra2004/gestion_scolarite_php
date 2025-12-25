<?php
require_once '../../config.php';


try {

    // 🔐 Sécurité : accès uniquement en POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id_prospect'])) {
        throw new Exception("Accès invalide");
    }

    $pdo->beginTransaction();

    // ================= PROSPECT =================
    $stmt = $pdo->prepare("SELECT * FROM prospects WHERE id_prospect = ?");
    $stmt->execute([$_POST['id_prospect']]);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$p) {
        throw new Exception("Prospect introuvable");
    }

    // ================= TUTEUR =================
    $id_tuteur = null;

    if (!empty($p['tuteur_cin']) || !empty($p['tuteur_email'])) {

        $stmt = $pdo->prepare("
            SELECT id_tuteur FROM tuteurs
            WHERE cin = :cin OR email = :email
            LIMIT 1
        ");
        $stmt->execute([
            ':cin'   => $p['tuteur_cin'],
            ':email' => $p['tuteur_email']
        ]);

        $tuteur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tuteur) {
            $id_tuteur = $tuteur['id_tuteur'];
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO tuteurs
                (nom, prenom, cin, telephone, email, lien_parente, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $p['tuteur_nom'],
                $p['tuteur_prenom'],
                $p['tuteur_cin'],
                $p['tuteur_telephone'],
                $p['tuteur_email'],
                $p['tuteur_lien_parente']
            ]);

            $id_tuteur = $pdo->lastInsertId();
        }
    }

    // ================= ÉTUDIANT =================
    $stmt = $pdo->prepare("
        INSERT INTO etudiants
        (nom, prenom, genre, civilite, date_naissance,
         nationalite, cin, email, telephone, adresse, ville,
         id_tuteur, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->execute([
        $p['nom'],
        $p['prenom'],
        $p['genre'],
        $p['civilite'],
        $p['date_naissance'],
        $p['nationalite'],
        $p['cin'],
        $p['email'],
        $p['telephone'],
        $p['adresse'],
        $p['ville'],
        $id_tuteur
    ]);

    // ================= MAJ PROSPECT =================
    $stmt = $pdo->prepare("
        UPDATE prospects
        SET id_etat = (
            SELECT id_etat FROM etats_prospect WHERE nom = 'Converti'
        ),
        updated_at = NOW()
        WHERE id_prospect = ?
    ");
    $stmt->execute([$p['id_prospect']]);

    $pdo->commit();

    // ✅ Message + redirection
    $_SESSION['alert'] = "✅ Prospect converti en étudiant avec succès.";
    header("Location: prospects.php"); // page prospects
    exit;

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['alert'] = "❌ Erreur conversion : " . $e->getMessage();
    header("Location: prospects.php");
    exit;
}
