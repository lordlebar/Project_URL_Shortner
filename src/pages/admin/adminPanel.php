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
    <title>Admin Panel | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../../../style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <style>
        body.dark .confirm-update {
            color: rgb(22, 22, 24);
        }

        .search form {
            display: flex;
            width: 235px;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s ease;
        }
    </style>

</head>

<body class='light' data-barba='wrapper'>
    <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/navbar.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/managers/initialize.php";
    // si non connecter ou non admin on redirige vers la page d'accueil
    // if (!isset($_SESSION['email']) || !$_SESSION['is_admin']) {
    //     echo "<script>location.href = '/Project_URL_Shortner';</script>";
    // }
    ?>
    <div class='full-content'>
        <main data-barba="container" data-barba-namespace="adminPanel">
                <div class="container" style="max-width: 1000px;">
                    <div class="main">
                        <h3>Admin Panel</h3>
                        <div class="d-flex justify-content-between align-items-center" style="margin-bottom:-15px; margin-top:20px">
                            <h4 style="margin-left: 2px; margin-top: 10px">List of Users</h4>
                            <form action='adminPanel.php' method='POST' class='form_search'>
                                <input type='text' name='search' class='form_text_input_search' placeholder='search...' />
                                <input type='submit' value='Search' class='btn btn-primary form-btn btn-search' />
                                <?php
                                if (isset($_POST['search']) && !empty($_POST['search'])) {
                                    $search = $_POST['search'];
                                    echo "<a href='adminPanel.php' class='h-25'><input type='submit' value='Clear' class='btn btn-secondary form-btn rounded-lg color_search' /></a>";
                                    echo '<input type=hidden id="search" value="' . $search . '"/>';
                                }
                                ?>
                            </form>
                        </div>

                        <!-- Tableau users -->
                        <div class='table-responsive pt-3'>
                            <table id=table_url class='table'>
                                <thead>
                                    <tr>
                                        <th scope=col>Name</th>
                                        <th scope=col>Email</th>
                                        <th scope=col>Valid</th>
                                        <th scope=col>Admin</th>
                                        <th scope=col>Update</th>
                                        <th scope=col>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id='bodyOfUsersArray'>
                                </tbody>
                            </table>
                        </div>

                        <div data-toggle="tooltip" data-placement="top" title="Add User">
                            <!-- button to add a new user with modal -->
                            <button class="rounded-circle btn btn-primary position-relative mt-4" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php
                echo "</main></div>";
                require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/modals/modalAdmin/addUserModal.php";
                require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/modals/modalAdmin/updateUserModal.php";
                require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/modals/modalAdmin/deleteUserModal.php";
                require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/footer.php";
            ?>

<script src="admin.js"></script>

</body>

</html>