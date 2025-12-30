<?php
require_once '../../config.php';


$matieres = $pdo->query("SELECT * FROM matieres ORDER BY id_matiere DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Matières | EduManager</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">

    <!-- Matière CSS -->
    <link rel="stylesheet" href="assets/css/matieres.css">

</head>
<body>

<div class="layout">

    <?php include '../partials/sidebar.php'; ?>
    <main class="main">

        <?php include '../partials/topbar.php'; ?>
        <?php include 'views/header.php'; ?>

        <?php include 'views/filters.php'; ?>

        <?php include 'views/groupe_grid.php'; ?>

       

        

<script src="assets/js/matieres.js"></script>

</body>
</html>
