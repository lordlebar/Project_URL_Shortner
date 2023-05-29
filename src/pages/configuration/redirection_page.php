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
	<title>Redirection Page | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style/style.css" rel="stylesheet">
</head>

<body class='light'>

	<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/navbar.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/managers/initialize.php";
	?>
	<div class="full-content">
			<div class="container" style="max-width: 600px;">
				<div class="main">
					<div class='alert alert-danger' id='invalid-url' role='alert'>
						<p><i class='fa-solid fa-triangle-exclamation'></i> URL does not exist</p>
					</div>
					<?php
					$short_url = $_GET["short_url"];

					if ($_SERVER["REQUEST_METHOD"] != "GET") {
						echo "<script>window.location.href = '/Project_URL_Shortner/';</script>";
						exit;
					} else if (empty($short_url)) {
						echo "<script>window.location.href = '/Project_URL_Shortner/';</script>";
						exit;
					} else if ($short_url[0] == '/')
						$short_url = substr($short_url, 1);

					$ends_with_plus = str_ends_with($short_url, "+");
					$ends_with_star = str_ends_with($short_url, "*");
					$ends_with_minus = str_ends_with($short_url, "-");

					if ($ends_with_plus || $ends_with_star || $ends_with_minus)
						$short_url = substr($short_url, 0, -1);

					$url = find_url_by_short_url($short_url);
					echo "<h3 style='text-align: center'>Redirection Page</h3>";
					if (!$url || filter_var($url[1], FILTER_VALIDATE_URL) === FALSE) {
						// go to the home page in javascript
						// affihce l'alert
						echo "<script>$('#invalid-url').show('medium'); setTimeout(function(){ $('#invalid-url').hide('medium'); }, 5000);</script>";

						// affiche long url non valide et redirige vers la page d'accueil
						echo "<p>The short URL : <strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong> is not valid</p>";
						$res = $url[1] ? $url[1] : 'Nothing...';
						echo "<p>this short url go to : $res </p>";
						echo "<h5>Redirecting to the home page in 10 seconds...</h5>";
					?>
						<script>
							setTimeout(function() {
								window.location.href = '/Project_URL_Shortner/';
							}, 10000);
						</script>
					<?php
						exit;
					}
					echo "<h4 style='margin-top: 30px'>";
					if ($ends_with_plus || str_ends_with($_SERVER["REQUEST_URI"], "+")) {
						echo "<p>The short URL : <a href=$url[1]><strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong></a></p>";
						echo "The final URL is : <a href=$url[1]>$url[1]</a>";
					} else if ($ends_with_star) {
						if ($url[2] > 1)
							echo "<strong style='color:rgba(240, 67, 43, 1)'>" . $url[2] . "</strong> clicks on the URL : <a href='$url[1]'><strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong></a>";
						else
							echo "<strong style='color:rgba(240, 67, 43, 1)'>" . $url[2] . "</strong> click on the URL : <a href='$url[1]'><strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong></a>";
					} else if ($ends_with_minus) {
						echo "The URL : <strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong> has been deleted";
						delete_url($short_url, $_SESSION["email"]);
					} else {
						increment_nb_click_by_short_url($short_url);
						echo "<script> window.location.href = '$url[1]'; </script>";
					}
					echo "</h4>";
					?>
				</div>
			</div>
	</div>

	<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/footer.php";
	?>
</body>

</html>
