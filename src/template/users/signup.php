<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Sign up | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style.css" rel="stylesheet">
	<!-- style dans l'index.php -->
</head>

<body>
	<?php
	require_once("../header.php");
	?>

	<div class="row">

		<div class="col-lg-6 container">

			<article class="main">

				<h3 style="text-align: center"> Sign up</h3>
				<br>
				<form action="signup.php" method="POST">
					<div class="form-group">
						<label for="name">Name : </label>
						<input type="text" name="name" required class="form-control" id="name">
					</div> <br>
					<div class="form-group">
						<label for="email">Email : </label>
						<input type="email" name="email" required class="form-control" id="email">
					</div> <br>
					<div class="form-group">
						<label for="password">Password : </label>
						<input type="password" name="password" required class="form-control" id="password">
					</div><br>
					<div class="form-group">
						<label for="confirmation_password">Confirmation password : </label>
						<input type="password" name="confirmation_password" required class="form-control" id="confirmation_password">
					</div>
					<br>
					<?php
					require_once("../../initialize.php");
					if ($_SERVER["REQUEST_METHOD"] == "POST") {

						$name = $_POST["name"];
						$email = $_POST["email"];
						$password = $_POST["password"];
						$confirmation_password = $_POST["confirmation_password"];
						echo "<h5>";
						if (!preg_match("/^[a-zA-Z0-9_-]*$/", $name))
							echo "<p>Username must contain only letters, numbers, _ and -";
						else if (is_email_exists($email))
							echo "<p>Email already exists";
						else if ($password != $confirmation_password)
							echo "<p>Passwords are different";
						else {

							$password = password_hash($password, PASSWORD_DEFAULT);
							insert_user($name, $email, $password, 0, 0);

							$token = generate_token();
							insert_token($token, $email);

							$subject = "Verified email";
							$content = "Please click on this link to verified your email and be able to connect : <a href=";
							$content .= "https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/verified_email.php?token=$token>Activate my email</a><p> or follow this link https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/users/verified_email.php?token=" . $token . "</p>";
							send_mail_to($email, $subject, $content);

							echo "<p style='color:rgb(60, 179, 113)'>A mail has been sent at $email to verified your email";
							// echo "<br /><a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/verified_email.php?token=$token>Verify email</a>";
						}
						echo " !</p></h5>";
					}
					?>
					<div class="d-grid gap-2 col-3 mx-auto" style="margin-bottom: -20px">
						<input type="submit" class="btn btn-primary" value="Sign up">
					</div>
				</form>

			</article>
		</div>
	</div>
</body>

</html>