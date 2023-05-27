
    <?php
    // reload page
    if (!isset($_SESSION))
        session_start();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/connexion.php";

    unset($_SESSION["is_logged"]);
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["is_admin"]);

    header("Location: '/Project_URL_Shortner/'");
    ?>
