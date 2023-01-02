<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Verified URL | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style.css" rel="stylesheet">
</head>

<body>
	<?php
	require_once("../header.php");
	require_once("../../initialize.php");
	?>
	<div class="row">

		<div class="col-lg-6 container">

			<article class="main">
				<h3 style="text-align: center">Activation email</h3>
				<?php
				require_once("../header.php");
				require_once("../../initialize.php");

				if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET["token"])) {
					header("Location: ../../../");
					die();
				}

				$token = $_GET["token"];
				$token = find_token_by_token($token);

				if ($token) {
					echo "<h4>";
					$email = $token[0];

					if (!$token[1]) {
						echo "<p>Your token has expired ! Please signup again.";
						delete_user_by_email($email);
					} else {
						set_user_verified($email, 1);
						echo "<p style='color:rgb(60, 179, 113); margin-top: 20px;'>Your account has been verified successfully !";
					}
					delete_token_by_email($email);
					echo "</p></h4>";
					echo "<a style='font-size: 20px' href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/login.php>Login</a>";
				} else {
					header("Location: ../../../");
					die();
				}
				?>
			</article>
		</div>
	</div>
</body>

</html>