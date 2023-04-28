<?php
require_once(realpath(dirname(__FILE__) . "/../db/connexion.php"));
require_once("initialize.php");

$res = get_all_url_by_email($_SESSION['email']);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

echo json_encode($rows);
