<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Links User | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../../../style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <style>
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
    // if not connected, die
    if (!isset($_SESSION['email']) || !$_SESSION['is_admin']) {
        echo "<script>location.href = '/Project_URL_Shortner';</script>";
    }
    ?>
    <div class='full-content'>
        <main data-barba="container" data-barba-namespace="linkUser">
            <div class="container" style="max-width: 1000px;">
                <div class="main position-relative">
                    <!-- <a href="adminPanel.php" class="btn btn-primary btn-rounded position-absolute"><i class="fas fa-arrow-left"></i></a> -->
                    <a href="adminPanel.php" class="btn btn-primary btn-rounded position-absolute" style="left: 0; top: 0; margin: 30px 0 0 40px;"><i class="fas fa-arrow-left"></i></a>
                    <h3>Links User</h3>
                    <div class="d-flex justify-content-between align-items-center" style="margin-bottom:-15px; margin-top:20px">

                        <h4 style="margin-left: 2px; margin-top: 10px">Links of User : <strong class="text-primary"> <?php echo $_GET['email'] ?></strong></h4>
                        <form action='linkUser.php?email=<?php echo $_GET['email'] ?>' method='POST' class='form_search'>
                            <input type='text' name='search' class='form_text_input_search' placeholder='search...' />
                            <input type='submit' value='Search' class='btn btn-primary form-btn btn-search' />
                            <?php
                            if (isset($_POST['search']) && !empty($_POST['search'])) {
                                $search = $_POST['search'];
                                echo '<input type=hidden id="search" value="' . $search . '"/>';
                                echo "<a href='linkUser.php?email" . $_GET['email'] . "'><input type='submit' value='Clear' class='btn btn-secondary form-btn rounded-lg color_search' /></a>";
                            }
                            ?>
                        </form>
                    </div>

                    <!-- Tableau links of users -->
                    <div class='table-responsive pt-3'>
                        <table id=table_url class='table'>
                            <thead>
                                <tr>
                                    <th scope=col>Short Url</th>
                                    <th scope=col>Long Url</th>
                                    <th scope=col>Numbers of clicks</th>
                                    <th scope=col>Update</th>
                                    <th scope=col>Delete</th>
                                </tr>
                            </thead>
                            <tbody id='bodyOfUrlsUserArray'>
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
    </div>


    <?php
    require_once("../../templates/footer.php");

    require_once("../../templates/modals/modalLinksUser/updateUrlUserModal.php");
    require_once("../../templates/modals/modalLinksUser/deleteUrlUserModal.php");

    ?>

    <script src="linkUser.js"></script>
</body>

</html>








<!-- <?php
        // button back to admin page
        echo "<div class='d-flex justify-content-center align-items-center'>
                            <a href='adminPanel.php' class='btn btn-primary btn-rounded'>Back to Admin Panel</a>
                        </div>";

        // affcihe tous les lien de l'utisateur avec pour mail en get
        $user = $_GET['email'];

        $links = get_all_url_by_email($user);

        // verify is user is admin
        $res = find_user_by_email($user);
        $is_admin = $res[3];

        if ($links->num_rows == 0) {
            if ($user == $_SESSION["email"])
                echo "<h4 class='title'>$user (You) have no link</h4>";
            else
                echo "<h4 class='title'><strong>$user</strong> has no link</h4>";
        } else if ($user == $_SESSION["email"]) {
            echo "<h5 class='title'>You can delete your links</h5>";
            tab($links, $is_admin, $user);
        } else if ($is_admin) {
            echo "<h5>$user is admin, you can't delete his links</h5>";
            tab($links, $is_admin, $user);
        } else {
            echo "<h5 class='title'>You can delete $user links because he is not an administrator</h5>";
            tab($links, $is_admin, $user);
        }

        function tab($links, $is_admin, $user)
        {
            echo "<div class='table-responsive'><table id=table_url class='table' style='width: 670px;'><thead><tr><th scope=col>Short url</th><th scopre=col>Long url</th><th scope=col>Numbers of clicks</th><th scope=col>Delete</th></tr></thead><tbody>";
            while ($row = $links->fetch_assoc()) {
                echo "<tr>";
                $short_url = $row["short_url"];
                $td_short_url = "<a href=http://" . $_SERVER["HTTP_HOST"] . "/$short_url>" . $_SERVER["HTTP_HOST"] . "/$short_url</a>";

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
                echo "<td><form method='post'><button type='submit' name='deleteLinkUser' value='$short_url' class='btn btn-danger btn-rounded'>Delete</button></form></td>";

                if (isset($_POST["deleteLinkUser"]) && $_POST["deleteLinkUser"] == $short_url) {
                    // if users is admin not delete link
                    if ($is_admin) {
                        // if the user is an administrator but it's his session, he can delete the link.
                        if ($user == $_SESSION["email"]) {
                            delete_url($short_url, $user);
                            echo "<script>location.reload();</script>";
                        }
                        // echo "<h5> $user, is admin, you can't delete his links</h5>";
                    } else { // if user is not admin, delete link
                        delete_url($short_url, $user);
                        echo "<script>location.reload();</script>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody></table></div>";
        }
        ?> -->