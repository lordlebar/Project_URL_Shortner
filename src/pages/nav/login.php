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
	<title>Login | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style/style.css" rel="stylesheet">
	<style>
		@media screen and (max-width: 550px) {
			.flex-row {
				flex-direction: column-reverse !important;
				margin-bottom: 0;
			}
		}
	</style>
</head>

<body class='light' data-barba='wrapper'>
	<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/navbar.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/managers/initialize.php";
	?>
	<div class='full-content'>
		<main data-barba="container" data-barba-namespace="login">


			<div class="container" style="max-width: 600px;">

				<div class="main">

					<h3>Log in</h3>
					<br>
					<form action="login.php" method="POST">
						<div class="form-group">
							<label for="email">Email : </label>
							<input type="email" name="email" required class="form-control" id="email">
						</div> <br>
						<div class="form-group">
							<label for="password">Password : </label>
							<input type="password" name="password" required class="form-control" id="password">
						</div>
						<br>
						<?php
						if (isset($_SESSION["is_logged"]) && $_SESSION["is_logged"]) {
							echo "<script>window.location.href = '/Project_URL_Shortner/';</script>";
						}

						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							$email = $_POST["email"];
							$password = $_POST["password"];

							$user = find_user_by_email($email);

							echo "<h5><p>";
							if (!$user)
								echo "Email doesn't exist";
							else if (!$user[4])
								echo "Email isn't verified";
							else if (!password_verify($password, $user[2]))
								echo "Incorrect password";
							else {
								$_SESSION["is_logged"] = 1;
								$_SESSION["name"] = $user[0];
								$_SESSION["email"] = $email;
								$_SESSION["is_admin"] = $user[3];
								echo "<script>window.location.href = '/Project_URL_Shortner/index.php';</script>";
							}
							echo " !</p></h5>";
						}
						?>
						<div class="d-grid gap-2 col-3 mx-auto">
							<input type="submit" class="btn btn-primary" value="Log in">
						</div>
					</form>
					<ul class='d-flex justify-content-between flex-row'>
						<li class="align-li"><a href="../configuration/forgot_password.php">Forgot password ?</a></li>
						<li class="align-li">Not registered ? <a href="signup.php">Create an Account</a></li>
					</ul>
				</div>
			</div>

		</main>
	</div>
	<?php
	require_once("../../templates/footer.php");
	?>
</body>

</html>