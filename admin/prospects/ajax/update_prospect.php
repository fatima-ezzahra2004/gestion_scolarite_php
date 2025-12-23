<?php
require_once __DIR__ . '/../../../config.php';

$id = $_POST['id_prospect'];

$sql = "
UPDATE prospects SET
    nom = :nom,
    prenom = :prenom,
    telephone = :telephone,
    whatsapp = :whatsapp,
    email = :email,
    cin = :cin,
    ville = :ville,
    nationalite = :nationalite,
    genre = :genre,
    civilite = :civilite,
    date_naissance = :date_naissance,
    id_canal = :id_canal,
    id_source = :id_source,
    id_etat = :id_etat,
    adresse = :adresse
WHERE id_prospect = :id
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'telephone' => $_POST['telephone'],
    'whatsapp' => $_POST['whatsapp'],
    'email' => $_POST['email'],
    'cin' => $_POST['cin'],
    'ville' => $_POST['ville'],
    'nationalite' => $_POST['nationalite'],
    'genre' => $_POST['genre'],
    'civilite' => $_POST['civilite'],
    'date_naissance' => $_POST['date_naissance'],
    'id_canal' => $_POST['id_canal'],
    'id_source' => $_POST['id_source'],
    'id_etat' => $_POST['id_etat'],
    'adresse' => $_POST['adresse'],
    'id' => $id
]);

echo 'success';
