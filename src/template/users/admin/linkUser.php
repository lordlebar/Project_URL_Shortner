<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Links User | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../../style.css" rel="stylesheet">
    <style>
        p {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
        }

        .supp {
            color: rgb(60, 179, 113);
        }

        .table {
            width: 70%;
            margin: auto;
        }

        .title {
            color: rgb(100, 100, 100);
            text-align: center;
            margin: 25px;
        }
    </style>
</head>

<?php
require_once("../../header.php");
require_once("../../../initialize.php");

// button back to admin page
echo "<div class='d-flex justify-content-center align-items-center'>
        <a href='adminPanel.php' class='btn btn-primary'>Back to admin page</a>
    </div>";

// affcihe tous les lien de l'utisateur avec pour mail en get

$user = $_GET['email'];

$links = get_all_url_by_email($user);

// verify is user is admin
$res = find_user_by_email($user);
$is_admin = $res[3];

if ($links->num_rows == 0) {
    echo "<p class='title'>User: $user has no link</p>";
    return;
}
echo "<h4 class='title'>Links of $user</h4>";

echo "<div class='table-responsive'><table id=table_url class='table'><thead><tr><th scope=col>Short url</th><th scopre=col>Long url</th><th scope=col>Numbers of clicks</th><th scope=col>Delete</th></tr></thead><tbody>";
while ($row = $links->fetch_assoc()) {
    echo "<tr>";
    $short_url = $row["short_url"];
    $td_short_url = "<a href=https://" . $_SERVER["HTTP_HOST"] . "/$short_url>" . $_SERVER["HTTP_HOST"] . "/$short_url</a>";

    $long_url = $row["long_url"];
    $mem_long_url = $long_url;
    // remove http or https from long url
    if (str_starts_with($long_url, "http://"))
        $long_url = substr($long_url, 7);
    else if (str_starts_with($long_url, "https://"))
        $long_url = substr($long_url, 8);

    $td_long_url = "<a href=$mem_long_url>$long_url</a>";

    echo "<td>$td_short_url</td><td>$td_long_url</td><td>" . $row["nb_click"] . "</td>";

    // delete button for each link
    echo "<td><form method='post'><button type='submit' name='deleteLinkUser' value='$short_url' class='btn btn-danger'>Delete</button></form></td>";

    if (isset($_POST["deleteLinkUser"]) && $_POST["deleteLinkUser"] == $short_url) {

        // if users is admin not delete link
        if ($is_admin) {
            echo "<h5>This user is admin, you can't delete his links</h5>";
        } else {
            // delete link
            delete_url($short_url, $user);
            echo "<script>location.reload();</script>";
        }
    }

    echo "</tr>";
}
echo "</tbody></table></div>";

?>