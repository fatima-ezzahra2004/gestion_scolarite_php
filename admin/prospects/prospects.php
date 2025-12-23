<?php
require_once '../../config.php';
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
        <div class="max-w-[1350px] mx-auto">
<?php if (!empty($_SESSION['alert'])): ?>
<div id="sessionAlert"
     class="mb-4 p-3 bg-orange-100 text-orange-700 rounded pt-4">
    <?= $_SESSION['alert']; ?>
</div>
<?php unset($_SESSION['alert']); endif; ?>


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
include 'modals/delete_modal.php';
?>
<script src="assets/js/prospects.js"></script>


</body>
</html>
