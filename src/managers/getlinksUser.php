<?php
require_once(realpath(dirname(__FILE__) . "/../db/connexion.php"));
require_once("initialize.php");

$user = $_GET['email'];

$res = get_all_url_by_email($user);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
echo json_encode($rows);
