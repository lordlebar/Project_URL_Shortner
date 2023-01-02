<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projet LAMP EXP2">
    <title>Admin Panel | ACQTX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../../style.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once("../../header.php");
    require_once("../../../initialize.php");
    ?>


    <div class="row">

        <div class="col-lg-8 container">

            <article class="main">

                <h3 style="text-align: center">Admin Panel</h3>
                <br>
                <div class="col-lg-10 container table-responsive">
                    <h4 style='margin-left: 3px; font-size: 21px'>List of Users</h4>
                    <?php
                    echo "<table id=table_url class='table'><thead><tr><th scope=col>#</th><th scopre=col>Name</th><th scope=col>Email</th><th scope=col>Is verified</th><th scope=col>Is admin</th><th scope=col>Action</th></tr></thead><tbody>";

                    $users = get_all_users();
                    $number = 0;

                    function formatBool($val)
                    {
                        if ($val == 1)
                            return 'Yes';
                        else
                            return 'No';
                    }

                    foreach ($users as $user) {
                        $number += 1;
                        echo "<tr>";
                        echo "<td>$number</td>";
                        echo "<td>$user[0]</td>";
                        if ($user[1] == $_SESSION['email'])
                            echo "<td><a class='links' href='https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/admin/linkUser.php?email=$user[1]'>$user[1] </a> ( You )</td>";
                        else
                            echo "<td><a class='links' href='https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/admin/linkUser.php?email=$user[1]'>$user[1]</a></td>";
                        echo "<td>" . formatBool($user[2]) . "</td>";
                        echo "<td>" . formatBool($user[3]) .  "</td>";
                        echo "<td><a class='links' href='https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/admin/deleteUser.php?email=$user[1]'><input type='button' class='btn btn-danger' value='Delete'></a></td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Is verified</th>
                            <th>Is admin</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> -->
                    </table>
                </div>
            </article>
        </div>
    </div>
</body>

</html>