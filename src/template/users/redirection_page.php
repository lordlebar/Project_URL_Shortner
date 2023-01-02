<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Redirection Page | ACQTX</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link href="../../../style.css" rel="stylesheet">
</head>

<body>
	<?php
	require_once("../header.php");
	require_once("../../initialize.php");
	?>
	<div class="d-flex justify-content-center align-items-center">
		<article class="main">
			<?php
			if ($_SERVER["REQUEST_METHOD"] != "GET") {
				header("Location: ../../..");
				die();
			}

			$short_url = $_GET["short_url"];
			if (empty($short_url)) {
				header("Location: ../../../");
				die();
			}

			if ($short_url[0] == '/')
				$short_url = substr($short_url, 1);

			$ends_with_plus = str_ends_with($short_url, "+");
			$ends_with_star = str_ends_with($short_url, "*");
			$ends_with_minus = str_ends_with($short_url, "-");

			if ($ends_with_plus || $ends_with_star || $ends_with_minus)
				$short_url = substr($short_url, 0, -1);

			$url = find_url_by_short_url($short_url);
			if (!$url) {
				header("Location: ../../..");
				die();
			}

			echo "<h3>";
			if ($ends_with_plus || str_ends_with($_SERVER["REQUEST_URI"], "+"))
				echo "The final URL is : <a href=" . $url[1] . ">" . $url[1] . " </a>";
			else if ($ends_with_star)
				echo "Total click: " . $url[2];
			else if ($ends_with_minus) {
				echo "The URL : <strong>" . $_SERVER["HTTP_HOST"] . "/$short_url</strong> has been deleted";
				delete_url($short_url, $_SESSION["email"]);
			} else {
				increment_nb_click_by_short_url($short_url);
				header("Location: " . $url[1]);
				die();
			}
			echo "</h3>";
			?>
		</article>
	</div>
</body>

</html>