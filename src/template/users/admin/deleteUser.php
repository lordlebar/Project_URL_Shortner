<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Delete User | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../../style.css" rel="stylesheet">
	<!-- style dans l'index.php -->
	<style>
		.deleteUser {
			text-align: center;
			font-size: 20px;
			font-weight: 600;
		}

		.admin {
			color: red;
		}

		.supp {
			color: rgb(60, 179, 113);
		}
	</style>
</head>

<body>
	<?php
	require_once("../../header.php");
	require_once("../../../initialize.php");
	?>
	<div class="row">

		<div class="col-lg-8 container">

			<article class="main">

				<h3 style="text-align: center">Delete User</h3>
				<br>

				<?php

				// recuperation de l'email de l'utilisateur a supprimer en get
				$email = $_GET['email'];

				$res = find_user_by_email($email);

				$is_admin = $res[3];

				if ($is_admin == true) {
					if ($_SESSION['email'] == $email) {
						echo "<p class='deleteUser admin'>Vous ne pouvez pas supprimer votre propre compte</p>";
					} else {
						echo "<p class=' deleteUser admin'>utilisateur : " . $email . '<br>';
						echo "Vous ne pouvez pas supprimer un administrateur</p>";
					}
					// echo "<p class='admin'>utilisateur : " . $email . '<br>';
					// echo "Vous ne pouvez pas supprimer un administrateur</p>";
				} else {
					echo "<p class='deleteUser supp'>L'utilisateur avec pour mail : $email a bien été supprimé</p>";
					delete_user_by_email($email);
				}

				// button pour retourner a la page d'administration des utilisateurs
				echo "<div class='d-flex justify-content-center align-items-center'>
						<a href='adminPanel.php' class='btn btn-primary'>Retour</a>
							</div>";
				?>
			</article>
		</div>
	</div>
</body>