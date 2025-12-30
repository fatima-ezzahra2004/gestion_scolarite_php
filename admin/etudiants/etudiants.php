<?php
require_once '../../config.php';
  include 'actions/list_etu_tut.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Étudiants & Tuteurs</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
 href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/pro_modal.css">
    <link rel="stylesheet" href="assets/css/modal.css">
</head>

<body>

<div class="layout">
            <?php include '../partials/sidebar.php'; ?>
    <main class="main">
            <?php include '../partials/topbar.php'; ?>
     

        <?php include 'actions/alert.php'; ?>

            <?php include 'views/header.php'; ?>
            <?php include 'views/filters.php'; ?>
            <?php include 'views/list_etudiants.php'; ?>

        </div>
    </main>
</div>
 <?php
include 'modals/add_etudiant_modal.php';
include 'modals/details_etudiants_modal.php';
include 'modals/edit_etudiant_modal.php';
include 'modals/archive_etudiant_modal.php';
include 'modals/delete_modal.php';


?>
<script src="assets/js/etudiants.js"></script>
</body>
</html>
