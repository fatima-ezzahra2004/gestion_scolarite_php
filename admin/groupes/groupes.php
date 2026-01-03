<?php

require_once '../../config.php';

$view = $_GET['view'] ?? 'normal';


require_once 'actions/list_groupes.php';


$stmt = $pdo->prepare("
    SELECT id_formation, nom
    FROM formations
    WHERE deleted_at IS NULL
    ORDER BY nom ASC
");
$stmt->execute();

$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Groupes | EduManager</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/pro_modal.css">
      
    <style>

</style>

</head>
<body>

<div class="layout">
            <?php include '../partials/sidebar.php'; ?>
    <main class="main">
            <?php include '../partials/topbar.php'; ?>
     

        <?php include 'actions/alert.php'; ?>

            <?php include 'views/header.php'; ?>
            <?php include 'views/filters.php'; ?>
            <?php include 'views/groupes_grid.php'; ?>

        </div>
    </main>
</div>
 <?php
include 'modals/add_groupe_modal.php';
include 'modals/details_groupe_modal.php';
include 'modals/edit_groupe_modal.php';
include 'modals/delete_modal.php';
include 'modals/restore_modal.php'; 

?>
<script type="module" src="assets/js/groupes.js"></script>


</body>
</html>
