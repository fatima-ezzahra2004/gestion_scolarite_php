<?php
require_once '../../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}   



?>
 <?php include 'ajax/load_selects.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier RDV | EduManager</title>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
<!-- css -->

    <link rel="stylesheet" href="../dashboard/assets/css/dashboard.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style> </style>
</head>
<body>



<div class="layout">
            <?php include '../partials/sidebar.php'; ?>
    <main class="main">
            <?php include '../partials/topbar.php'; ?>
        <div class="max-w-full  px-10">



          
<div class="w-full mt-6 bg-white p-6 rounded-lg shadow">
    <h1 class="text-xl font-semibold mb-4">Calendrier des Rendez-vous</h1>
    <div id="calendar" class="w-full"></div>
    <!-- LÉGENDE STATUT RDV -->
<div class="flex items-center gap-6 mt-4 text-sm">

    <div class="flex items-center gap-2">
        <span class="w-3 h-3 rounded-full bg-sky-500"></span>
        <span>Planifié</span>
    </div>

    <div class="flex items-center gap-2">
        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
        <span>Traité</span>
    </div>

    <div class="flex items-center gap-2">
        <span class="w-3 h-3 rounded-full bg-red-500"></span>
        <span>Annulé</span>
    </div>

</div>

</div>

        </div>
    </main>

 <?php include 'modals/add_rdv.php'; ?>

<?php include 'modals/edit_supp_rdv.php'; ?>

<script src="assets/js/calendar.js"></script>
</body>
</html>
