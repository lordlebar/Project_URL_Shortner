<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Change Password | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../../../style/style.css" rel="stylesheet">
</head>

<body class='light' data-barba='wrapper'>
    <?php
    require_once("../../templates/navbar.php");
    require_once("../../managers/initialize.php");
    ?>

    <div class='full-content'>
        <main data-barba="container" data-barba-namespace="change_password">
            <div class="container" style="max-width: 600px;">
                <div class="main">

                    <h3>Change password</h3>
                    <br>
                    <p>Change password for <strong><?php echo $_SESSION["email"] ?? $_GET['email'] ?></strong></p>
                    <form action="change_password.php" method="POST">
                        <?php
                        if ($_SESSION["is_logged"]) {
                            echo '<div class="form-group">
                            <label for="name">Old password : </label>
                            <input type="password" name="old_password" required class="form-control" id="old_password">
                        </div> <br>';
                        }
                        ?>
                        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                        <div class="form-group">
                            <label for="password">New password : </label>
                            <input type="password" name="new_password" required class="form-control" id="new_password">
                        </div><br>
                        <div class="form-group">
                            <label for="confirmation_password">Confirmation new password : </label>
                            <input type="password" name="confirmation_new_password" required class="form-control" id="confirmation_new_password">
                        </div>
                        <br>
                        <?php
                        echo "<h5>";
                        if ($_SESSION["is_logged"] && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"]) && isset($_POST["confirmation_new_password"])) {
                            $old_password = $_POST["old_password"];
                            $new_password = $_POST["new_password"];
                            $confirmation_new_password = $_POST["confirmation_new_password"];
                            $user = find_user_by_email($_SESSION["email"]);
                            if (!password_verify($old_password, $user[2]))
                                echo "<p>Incorrect old password";
                            else if ($new_password != $confirmation_new_password)
                                echo "<p>New password and confirmation new password are different !";
                            else if ($old_password == $new_password)
                                echo "<p>New password is the same as the old password !";
                            else {
                                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                                modify_passord_user($new_password, $_SESSION["email"]);
                                echo "<p style='color:rgb(60, 179, 113)'>Password changed !";
                            }
                            echo "</p>";
                        } else {
                            $email = $_POST['email'];
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"]) && isset($_POST["confirmation_new_password"])) {
                                $new_password = $_POST["new_password"];
                                $confirmation_new_password = $_POST["confirmation_new_password"];
                                if ($new_password != $confirmation_new_password)
                                    echo "<p>New password and confirmation new password are different !";
                                else {
                                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                                    modify_passord_user($new_password, $email);
                                    echo "<p style='color:rgb(60, 179, 113)'>Password changed ! try to <a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/nav/login.php>login</a> again";
                                }
                            }
                        }
                        echo "</h5>";
                        ?>
                        <div style='text-align: center; margin-bottom: -20px;'>
                            <input type="submit" class="btn btn-primary" value="Change password">
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>
    <?php
    require_once("../../templates/footer.php");
    ?>
</body>

</html>