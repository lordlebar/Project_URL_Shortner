<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Profile | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style.css" rel="stylesheet">
    <!-- style dans l'index.php -->
</head>

<body>
    <?php
    require_once("../header.php");
    require_once("../../initialize.php");
    ?>

    <div class="row">

        <div class="col-lg-8 container">

            <article class="main">

                <h3 style="text-align: center">Your Profile</h3>
                <br>
                <!-- vos donnees actuelle -->
                <div class="form-group">
                    <h6>Your data :</h6>
                    <?php
                    echo 'Your Name : <strong>' . $_SESSION['name'] . '</strong><br />';
                    echo 'Your Email : <strong>' . $_SESSION['email'] . "</strong><br />";
                    if ($_SESSION['is_admin']) {
                        echo "Admin : <strong>Yes</strong>, access the  ";
                        echo "<a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/admin/adminPanel.php>Admin Panel</a><br />";
                    }
                    echo "<br /><a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/change_password.php>Change password ?</a>";
                    ?>

                </div>
            </article>
        </div>
</body>

</html>