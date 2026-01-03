<?php
require_once '../../config.php';

function generatePassword($prenom, $nom) {
    $prenom = strtolower(preg_replace('/\s+/', '', $prenom));
    $nom    = strtolower(preg_replace('/\s+/', '', $nom));
    $rand   = random_int(100, 999);

    return $prenom . '.' . $nom . $rand;
}

try {

    /* ===============================
       🔐 SÉCURITÉ
    ================================ */
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id_prospect'])) {
        throw new Exception("Accès invalide");
    }

    $id_prospect = (int) $_POST['id_prospect'];
    $pdo->beginTransaction();

    /* ===============================
       1️⃣ RÉCUPÉRER LE PROSPECT
    ================================ */
    $stmt = $pdo->prepare("SELECT * FROM prospects WHERE id_prospect = ?");
    $stmt->execute([$id_prospect]);
    $p = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$p) {
        throw new Exception("Prospect introuvable");
    }

    /* ===============================
       2️⃣ VÉRIFIER EMAIL UNIQUE
    ================================ */
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$p['email']]);
    if ($stmt->fetch()) {
        throw new Exception("Un compte existe déjà avec cet email");
    }

    /* ===============================
       3️⃣ GÉNÉRER MOT DE PASSE
    ================================ */
    $plainPassword  = generatePassword($p['prenom'], $p['nom']);
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    /* ===============================
       4️⃣ CRÉER LE COMPTE USER
    ================================ */
    $stmt = $pdo->prepare("
        INSERT INTO users (
            nom, prenom, nom_ar, prenom_ar,
            email, password, cin,
            telephone, whatsapp, adresse,
            ville, ville_ar,
            date_naissance, nationalite, genre,
            role
        ) VALUES (
            ?, ?, ?, ?,
            ?, ?, ?,
            ?, ?, ?,
            ?, ?,
            ?, ?, ?,
            'etudiant'
        )
    ");

    $stmt->execute([
        $p['nom'],
        $p['prenom'],
        $p['nom_ar'],
        $p['prenom_ar'],
        $p['email'],
        $hashedPassword,
        $p['cin'],
        $p['telephone'],
        $p['whatsapp'],
        $p['adresse'],
        $p['ville'],
        $p['ville_ar'],
        $p['date_naissance'],
        $p['nationalite'],
        $p['genre']
    ]);

    $user_id = $pdo->lastInsertId();

    /* ===============================
       5️⃣ METTRE À JOUR LE PROSPECT
    ================================ */
    $stmt = $pdo->prepare("
        UPDATE prospects
        SET id_etat = (
            SELECT id_etat FROM etats_prospect
            WHERE nom = 'Converti' LIMIT 1
        ),
        updated_at = NOW()
        WHERE id_prospect = ?
    ");
    $stmt->execute([$id_prospect]);

    $pdo->commit();

    /* ===============================
       6️⃣ MESSAGE ADMIN (mot de passe visible UNE FOIS)
    ================================ */
    $_SESSION['alert'] =
        "Compte étudiant créé.<br>
         Email : <strong>{$p['email']}</strong><br>
         Mot de passe : <strong>{$plainPassword}</strong><br>
         À communiquer immédiatement à l’étudiant.";

    header("Location: prospects.php?user_id=" . $user_id);
    exit;

} catch (Exception $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['alert'] = "❌ Erreur conversion : " . $e->getMessage();
    header("Location: prospects.php");
    exit;
}
