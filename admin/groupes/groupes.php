<?php
require_once '../../config.php';
require_once 'actions/list_groupe.php';

// groupes normaux
$groupes = $pdo->query("
    SELECT g.*, f.nom AS formation_nom
    FROM groupes g
    LEFT JOIN formations f ON g.id_formation = f.id_formation
    WHERE g.deleted_at IS NULL
    ORDER BY g.nom_fr
")->fetchAll(PDO::FETCH_ASSOC);

// historique
$deleted_groupes = $pdo->query("
    SELECT g.*, f.nom AS formation_nom
    FROM groupes g
    LEFT JOIN formations f ON g.id_formation = f.id_formation
    WHERE g.deleted_at IS NOT NULL
    ORDER BY g.deleted_at DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Groupes</title>
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">
  
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="assets/css/groupes.css">


 
</head>
<body>

<div class="layout">
    <?php include '../partials/sidebar.php'; ?>

    <main class="main">
        <?php include '../partials/topbar.php'; ?>



      <?php include 'views/header.php'; ?>
       <?php include 'views/filters.php';?>

       

       <?php include 'views/groupe_grid.php';?>
            
       <?php include 'modals/restore_modal.php';?>

       <?php include 'actions/alert.php'; ?>

        <?php
        include 'modals/add_groupe_modal.php';
        include 'modals/edit_groupe_modal.php';
        include 'modals/delete_modal.php';
        
        ?>


    </main>
</div>
<script src="assets/js/groupes.js"></script>



</body>
</html>
