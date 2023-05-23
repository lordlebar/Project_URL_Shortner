
    <?php
    // reload page
    session_start();

    require_once("./src/db/connexion.php");

    unset($_SESSION["is_logged"]);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["is_admin"]);

    header("Location: '/Project_URL_Shortner/'");
    ?>
