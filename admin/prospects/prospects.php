<?php

require_once '../../config.php';

$view = $_GET['view'] ?? 'active'; // active | trash
require_once 'actions/list_etats.php';
require_once 'actions/list_prospects.php';
require_once 'actions/helpers.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Prospects | EduManager</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/pro_modal.css">
        <link rel="stylesheet" href="assets/css/modal.css">
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
            <?php include 'views/prospects_grid.php'; ?>

        </div>
    </main>
</div>
 <?php
include 'modals/add_prospect_modal.php';
include 'modals/details_prospect_modal.php';
include 'modals/edit_prospect_modal.php';
include 'modals/convertir_modal.php';
include 'modals/delete_modal.php';
include 'modals/restore_modal.php';
include 'modals/force_delete_modal.php';  

?>
<script type="module" src="assets/js/prospects.js"></script>


</body>
</html>
