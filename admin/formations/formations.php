<?php

require_once '../../config.php';

$view = $_GET['view'] ?? 'normal';


require_once 'actions/list_formations.php';


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formations | EduManager</title>

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
            <?php include 'views/formations_grid.php'; ?>

        </div>
    </main>
</div>
 <?php
include 'modals/add_formation_modal.php';
include 'modals/details_formation_modal.php';
include 'modals/edit_formation_modal.php';
include 'modals/delete_modal.php';
include 'modals/restore_modal.php'; 

?>
<script src="assets/js/formations.js"></script>


</body>
</html>
