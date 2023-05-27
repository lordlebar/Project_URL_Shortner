<?php
include '../db/connexion.php';
require_once("initialize.php");

$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($rows);
