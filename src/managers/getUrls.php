<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/connexion.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/managers/initialize.php";

$res = get_all_url_by_email($_SESSION['email']);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

echo json_encode($rows);
