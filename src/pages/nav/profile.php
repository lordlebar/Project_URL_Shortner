<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/connexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Profile | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../../../style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .name_change {
            display: flex;
            transition: all 0.5s ease;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 5px;
        }

        .name_change form {
            display: flex;
            width: 235px;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }

        .name_change p {
            margin: 0;
            padding: 0 10px 0 0;
        }

        .form-text-input {
            width: 140px;
            height: 30px;
            padding: 0 0 0 10px !important;
            font-size: 14px;
        }

        .form-btn {
            padding: 0 20px 0 20px !important;
            height: 28px;
            font-size: 14px;
        }

        /*  ecran a  600 px */
        @media screen and (max-width: 600px) {
            .name_change {
                flex-direction: column;
                align-items: start;
            }

            .name_change p {
                padding: 0;
            }

        }
    </style>
</head>

<body class='light' data-barba='wrapper'>
    <?php
    require_once("../../templates/navbar.php");
    require_once("../../managers/initialize.php");
    // si non connecter on die
    if (!isset($_SESSION['email'])) {
        die("You are not connected");
    }
    ?>

    <div class='full-content'>
        <main data-barba="container" data-barba-namespace="profile">
            <div class="container" style="max-width: 650px;">

                <div class="main">

                    <h3>Your Profile</h3>
                    <br>
                    <!-- vos donnees actuelle -->
                    <div class="form-group">
                        <h6><strong>Your data :</strong></h6>
                        <?php
                        $email = $_SESSION['email'];
                        ?>
                        <div class='name_change'>
                            <p>Your Name : <strong><?php echo $_SESSION['name'] ?></strong></p>

                            <!-- input pour modifier son nom -->
                            <form action='profile.php' method='POST' class='form_name_change'>
                                <input type='text' name='name' class='form-text-input' placeholder='New name' />
                                <input type='submit' value='Change' class='btn btn-primary form-btn' />
                            </form>
                        </div>
                        <?php
                        // si le nom est modifier
                        if (isset($_POST['name']) && !empty($_POST['name'])) {
                            $name = $_POST['name'];

                            echo "<h5>";
                            // Username must contain only letters, numbers, _ and -, and spaces
                            if (!preg_match("/^[a-zA-Z0-9 _-]+$/", $name))
                                echo "<p>Name must contain only letters, numbers, _ and -, and spaces, but less of 20 characters";
                            else if (strlen($name) > 20)
                                echo "<p>Name must contain less than 20 characters";
                            else {
                                set_name_user($name, $email);
                                // on met a jour la session
                                $_SESSION['name'] = $name;
                                // reload page
                                echo "<script>window.location.href = 'profile.php';</script>";
                            }
                            echo "</h5>";
                        }
                        ?>

                        <div class='name_change'>
                            <p>Your Email : <strong><?php echo $email ?></strong></p>
                            <!-- input pour modifier son email -->
                            <form action='profile.php' method='POST' class='form_name_change'>
                                <input type='email' name='email' class='form-text-input' placeholder='New email' />
                                <input type='submit' value='Change' class='btn btn-primary form-btn' />
                            </form>
                        </div>
                        <?php
                        if (isset($_POST['email']) && !empty($_POST['email'])) {
                            $new_email = $_POST['email'];

                            echo "<h5>";
                            // email must contain only letters, numbers, _ and -, and spaces
                            if (!filter_var($new_email, FILTER_VALIDATE_EMAIL))
                                echo "<p>Email must be a valid email address";
                            else if (strlen($new_email) > 50)
                                echo "
                            <p>Email must contain less than 50 characters";
                            else {
                                set_email_user($new_email, $email);
                                // on met a jour la session
                                $_SESSION['email'] = $new_email;
                                // reload page
                                echo "<script> window.location.href = 'profile.php'; </script>";
                            }
                            echo "</h5>";
                        }

                        // total of clicks links
                        $total = totalClicks_user($email);

                        if ($total[0] > 1)
                            echo '<p>Total clicks of your links : <strong>' . $total[0] . " clicks</strong></p>";
                        else
                            echo '<p>Total click of your links : <strong>' . ($total[0] ? $total[0] : 0) . " click</strong></p>";
                        if ($_SESSION['is_admin']) {
                            echo "<p>Admin : <strong>Yes</strong>, access to the ";
                            echo "<a href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/admin/adminPanel.php>Admin Panel</a></p>";
                        } // suppression du compte avec modal confirmation 
                        echo "<button type='button' class='btn btn-danger btn-rounded' data-bs-toggle='modal' data-bs-target='#deleteModal'><i class='fa-solid fa-trash-can'></i> Delete your account</button><br />";
                        echo "<br /><a href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/configuration/change_password.php>Change password ?</a>";
                        ?>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php
    require_once("../../templates/modals/modalProfile/deleteModal.php");
    require_once("../../templates/footer.php");
    ?>
</body>

</html>