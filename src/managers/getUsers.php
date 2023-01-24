<?php
include '../db/connexion.php';
require_once("initialize.php");

if (!isset($_SESSION['email'])) {
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($rows);
