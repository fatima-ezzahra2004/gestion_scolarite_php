<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | EduManager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<div class="layout">

     <?php include '../partials/sidebar.php'; ?>
    <main class="main">

        <!-- TOPBAR -->
        <?php include '../partials/topbar.php'; ?>

        <!-- CONTENT -->
        <section class="content">

            <h1>Tableau de bord</h1>
            <p class="subtitle">Bienvenue <?= $_SESSION['nom']; ?>.</p>

            <!-- STATS -->
            <div class="stats">
                <div class="card blue">
                    <p>Total Prospects</p>
                    <h2>127</h2>
                    <span>+12% ce mois</span>
                </div>

                <div class="card green">
                    <p>Étudiants Actifs</p>
                    <h2>842</h2>
                    <span>+5% ce mois</span>
                </div>
   
                <div class="card light-green">
                    <p>Formations</p>
                    <h2>24</h2>
                </div>

                <div class="card orange">
                    <p>RDV Aujourd’hui</p>
                    <h2>8</h2>
                </div>
            </div>

            <!-- CONVERSION -->
            <div class="conversion">
                <div>
                    <p>Taux de conversion ce mois</p>
                    <h2>68.5%</h2>
                    <span>87 prospects convertis sur 127</span>
                </div>
            </div>

            <!-- TABLES -->
            <div class="tables">

                <!-- PROSPECTS -->
                <div class="box">
                    <h3>Prospects récents</h3>

                    <div class="item">
                        <div>
                            <strong>Youssef Benali</strong>
                            <span>Licence Informatique</span>
                        </div>
                        <span class="badge blue">Nouveau</span>
                    </div>

                    <div class="item">
                        <div>
                            <strong>Sara El Amrani</strong>
                            <span>Master Marketing</span>
                        </div>
                        <span class="badge orange">Contacté</span>
                    </div>

                    <div class="item">
                        <div>
                            <strong>Ahmed Tazi</strong>
                            <span>Formation Continue</span>
                        </div>
                        <span class="badge green">Intéressé</span>
                    </div>
                </div>

                <!-- RDV -->
                <div class="box">
                    <h3>Rendez-vous à venir</h3>

                    <div class="rdv">
                        <strong>Consultation initiale</strong>
                        <span>Youssef Benali</span>
                        <small>20 déc · 10:00</small>
                    </div>

                    <div class="rdv">
                        <strong>Demande d'information</strong>
                        <span>Sara El Amrani</span>
                        <small>20 déc · 14:30</small>
                    </div>

                </div>

            </div>

        </section>
    </main>

</div>

</body>
</html>
