<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/connexion.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/managers/initialize.php";

if (!isset($_SESSION['email'])) {
    // go to login page
    echo "<script>location.href = '/Project_URL_Shortner';</script>";
}

if (!isset($_POST['search'])) {
    // go to login page
    echo "<script>location.href = '/Project_URL_Shortner';</script>";
}
$search = $_POST['search'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM urls WHERE email like '$email' && (short_url like '%$search%' || long_url like '%$search%');";
$res = query($sql);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

echo json_encode($rows);

?>
