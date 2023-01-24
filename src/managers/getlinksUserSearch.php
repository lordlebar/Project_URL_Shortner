<?php
include '../db/connexion.php';
require_once("initialize.php");

if (!isset($_SESSION['email'])) {
    // go to login page
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

if (!isset($_POST['search'])) {
    // go to login page
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

if (!isset($_POST['email'])) {
    // go to login page
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

$search = $_POST['search'];
$email = $_POST['email'];
$sql = "SELECT * FROM urls WHERE email like '$email' && (short_url like '%$search%' || long_url like '%$search%');";
$res = query($sql);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

echo json_encode($rows);

?>
