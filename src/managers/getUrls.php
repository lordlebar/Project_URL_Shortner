<?php
include '../db/connexion.php';

require_once("initialize.php");

if (!isset($_SESSION['email'])) {
    echo "<script>location.href = '/Projet_Lamp_EXP2';</script>";
}

$res = get_all_url_by_email($_SESSION['email']);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

echo json_encode($rows);
