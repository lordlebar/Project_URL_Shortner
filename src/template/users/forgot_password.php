<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Forgot Password | ACQTX</title>
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
        <div class="col-lg-6 container">
            <article class="main">
                <!-- formulaire forgot password -->
                <h3 style="text-align: center">Forgot password</h3>
                <br>
                <form action="forgot_password.php" method="POST">
                    <div class="form-group
                ">
                        <label for="email">Email : </label>
                        <input type="email" name="email" required class="form-control" id="email">
                    </div> <br>
                    <div class="d-grid gap
                -2 col-3 mx-auto">
                        <input type="submit" class="btn btn-primary" value="Send">
                    </div>
                    <?php
                    require_once("../../initialize.php");
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
                        $email = $_POST["email"];

                        echo "<h5>";
                        $user = find_user_by_email($email);
                        if ($user[4] != 1) {
                            echo "<p>This email is not verified ! check $mail </p>";
                            echo "</h5>";
                            return;
                        }

                        $subject = "Change password";
                        $content = "Please click on this link to change your password and be able to connect : <a href=";
                        $content .= "https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/change_password.php?email=$email>Change my password</a><p> or follow this link https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/users/change_password.php?email=" . $email . "</p>";
                        send_mail_to($email, $subject, $content);

                        echo "<p style='color:rgb(60, 179, 113)'>A mail has been sent at $email to change your password";
                        // echo "<br /><a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/change_password.php?email=$email>Change my password</a>";
                        echo " !</p></h5>";
                    }
                    ?>
                </form>
            </article>
        </div>
    </div>
</body>