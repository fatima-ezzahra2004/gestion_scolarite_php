<?php
require_once '../../config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM matieres WHERE id=?");
    $stmt->execute([$id]);
    $matiere = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($matiere);
}
?>
