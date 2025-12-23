<?php


/* ================= EMPLOYÉS + CATÉGORIES ================= */
$employes = $pdo->query("
    SELECT 
        e.id_employe,
        e.nom_fr,
        e.prenom_fr,
        c.nom AS categorie
    FROM employes e
    LEFT JOIN categories_employes c 
        ON c.id_categorie = e.id_categorie
    ORDER BY c.nom, e.nom_fr
")->fetchAll(PDO::FETCH_ASSOC);

/* ================= PROSPECTS ================= */
$prospects = $pdo->query("
    SELECT id_prospect, nom, prenom
    FROM prospects
    ORDER BY nom
")->fetchAll(PDO::FETCH_ASSOC);
