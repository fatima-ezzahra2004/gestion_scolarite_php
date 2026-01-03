<?php
require_once __DIR__ . '/../../../config.php';

$id = $_POST['id_etudiant'] ?? null;
if (!$id) exit('error');


    /* ===============================
       1️⃣ UPDATE ETUDIANT
    ================================ */
    $stmt = $pdo->prepare("
        UPDATE etudiants SET
            nom = :nom,
            prenom = :prenom,
            telephone = :telephone,
            email = :email,
            cin = :cin,
            ville = :ville,
            adresse = :adresse,
            genre = :genre,
            date_naissance = :date_naissance
        WHERE id_etudiant = :id
    ");

    $stmt->execute([
        'nom' => $_POST['nom'] ?? null,
        'prenom' => $_POST['prenom'] ?? null,
        'telephone' => $_POST['telephone'] ?? null,
        'email' => $_POST['email'] ?? null,
        'cin' => $_POST['cin'] ?? null,
        'ville' => $_POST['ville'] ?? null,
        'adresse' => $_POST['adresse'] ?? null,
        'genre' => $_POST['genre'] ?? null,
        'date_naissance' => $_POST['date_naissance'] ?? null,
        'id' => $id
    ]);

    /* ===============================
       2️⃣ GESTION DU TUTEUR
    ================================ */
    $tuteur_nom    = $_POST['tuteur_nom'] ?? null;
    $tuteur_prenom = $_POST['tuteur_prenom'] ?? null;
    $tuteur_tel    = $_POST['tuteur_tel'] ?? null;
    $lien_parente  = $_POST['lien_parente'] ?? null;

    if ($tuteur_nom || $tuteur_prenom || $tuteur_tel || $lien_parente) {

        $stmt = $pdo->prepare("SELECT id_tuteur FROM etudiants WHERE id_etudiant = ?");
        $stmt->execute([$id]);
        $id_tuteur = $stmt->fetchColumn();

        if ($id_tuteur) {
            // 🔁 UPDATE
            $stmt = $pdo->prepare("
                UPDATE tuteurs SET
                    nom = :nom,
                    prenom = :prenom,
                    telephone = :telephone,
                    lien_parente = :lien
                WHERE id_tuteur = :id
            ");
            $stmt->execute([
                'nom' => $tuteur_nom,
                'prenom' => $tuteur_prenom,
                'telephone' => $tuteur_tel,
                'lien' => $lien_parente,
                'id' => $id_tuteur
            ]);
        } else {
            // ➕ INSERT
            $stmt = $pdo->prepare("
                INSERT INTO tuteurs (nom, prenom, telephone, lien_parente)
                VALUES (:nom, :prenom, :telephone, :lien)
            ");
            $stmt->execute([
                'nom' => $tuteur_nom,
                'prenom' => $tuteur_prenom,
                'telephone' => $tuteur_tel,
                'lien' => $lien_parente
            ]);

            $pdo->prepare("
                UPDATE etudiants SET id_tuteur = ?
                WHERE id_etudiant = ?
            ")->execute([$pdo->lastInsertId(), $id]);
        }
    }

  
    echo 'success';

