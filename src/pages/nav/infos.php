<?php
require_once ("./src/db/connexion.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Infos | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../../../style/style.css" rel="stylesheet">
</head>

<body class='light' data-barba='wrapper'>

    <!-- info du site comment il fonctionne etc... -->
    <?php
    require_once("../../templates/navbar.php");
    require_once("../../managers/initialize.php");
    ?>
    <div class='full-content'>
        <main data-barba="container" data-barba-namespace="infos">
            <div class="container" style="max-width: 800px;">
                <div class="main">
                    <!-- formulaire forgot password -->
                    <h3>Infos</h3>
                    <br>
                    <?php

                    echo "<h4> Here you'll find all necessary informations for better use of our website. Take your time to read ! </h4><br>";

                    echo "<h3>Description: </h3>";
                    echo "<p>Our tool is meant for all users who needs to get shorten any URL. This can be done in only one click with ACQTX, and then shared with anyone you want to.</p>";

                    echo "<h3>How it works?</h3>";
                    if ($_SESSION["is_logged"]) {
                        echo "<p>The user enters the link that needs to be shortened in the main field. Then he can choose an alias for that URL or let the website generate an random alias (by letting the field empty). Once this is done, the shortened URL will be available and ready to use or shared. </p>";

                    } else {
                        echo "<p>The user enters the link that needs to be shortened in the main field. Then the website will an random alias. Once this is done, the shortened URL will be available and ready to use or shared.  </p>";
                    }

                    echo "<h3>Benefits ?</h3>";
                    if ($_SESSION["is_logged"]) {
                        echo "<p>Shortened URLS are easy to manipulate, shared or sent by email. This tool aims to reduce the length of any link, to ease sharing, and give you a platform to track all of your shortened links. </p>";

                    } else {
                        echo "<p>Shortened URLS are easy to manipulate, shared or sent by email. This tool aims to reduce the length of any link and to ease sharing. </p>";
                    }

                    echo "<h3>About Us</h3>";

                    echo "<p>We are Computer science engineers to be, studying at EPITA. Our team is called : ACQTX </p>";

                    echo "<h3>Stack</h3>";
                    echo "<p>This website was developed using PHP, HTML, CSS, Bootstrap, Javascript, MySQL. </p>";

                    echo "<h3>Functionalities</h3>";
                    if ($_SESSION["is_logged"]) {
                        echo "<p>You can: </p>";
                        echo "<ul>";
                        echo "<li>Create an account</li>";
                        echo "<li>Login</li>";
                        echo "<li>Logout</li>";
                        echo "<li>Modify your password</li>";
                        echo "<li>Delete your account</li>";
                        echo "<li>Shorten any URL</li>";
                        echo "<li>Delete any shortened URL</li>";
                        echo "<li>Modify shortened URLs</li>";
                        echo "<li>Redirect to an URL</li>";
                        echo "<li>Track the number of clicks to your url</li>";
                        echo "<li>Modify your profile(name)</li>";
                        echo "<ul>";
                    }




                    // if ($_SESSION["is_logged"]) {
                    //     echo "<p>Vous êtes connecté en tant que : <strong>" . $_SESSION['email'] . "</strong></p>";



                    //     echo "<p>Vous pouvez accéder à votre profil en cliquant sur le bouton <strong>Profile</strong> dans la barre de navigation.</p>";
                    //     if ($_SESSION["is_admin"]) {
                    //         echo "<p>Vous êtes <strong>administrateur</strong> du site, vous pouvez accéder à la page d'administration en cliquant sur le bouton <strong>Admin Panel</strong> dans la barre de navigation.</p>";
                    //     }


                    //     echo "Vous pouvez vous déconnecter en cliquant sur le bouton <strong>Logout</strong> dans la barre de navigation.";
                    // } else {
                    //     echo "<p>Vous n'êtes pas connecté.</p>";
                    // }

                    ?>
                    <!-- <p>Vous pouvez vous inscrire sur le site pour pouvoir accéder à toutes les fonctionnalités du site.</p> -->

                </div>
            </div>
        </main>
    </div>
    <?php
    require_once("../../templates/footer.php");    ?>
</body>

</html>