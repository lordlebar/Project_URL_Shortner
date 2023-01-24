<?php
include '../db/connexion.php';
require_once("initialize.php");

if (!isset($_SESSION['email'])) {
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

if (!isset($_POST['search'])) {
    echo "<script>location.href = '/Projet_Lamp_EXP2/src/pages/admin/adminPanel.php';</script>";
}
$search = $_POST['search'];
$sql = "SELECT * FROM users WHERE name like '%$search%' || email like '%$search%'";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($rows);
