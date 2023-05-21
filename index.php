<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	echo phpinfo();
	exit;
	?>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Projet LAMP EXP2</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style/style.css">
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
	require_once("src/templates/navbar.php");
	require_once("src/managers/initialize.php");
	?>

	<!--
		INSERT INTO `users`(`name`, `email`, `password`, `is_admin`, `is_verified`) VALUES ('Corentin','corentin','$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW',0,1);
		INSERT INTO `users`(`name`, `email`, `password`, `is_admin`, `is_verified`) VALUES ('Corentin','corentin.lebarilier@gmail.com','$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW',0,1);
		INSERT INTO `users`(`name`, `email`, `password`, `is_admin`, `is_verified`) VALUES ('Admin','admin@admin.fr','$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW',1,1);
		INSERT INTO `users`(`name`, `email`, `password`, `is_admin`, `is_verified`) VALUES ('Corentin','corentin@admin.fr','$2y$10$BP.OXy.FFgJg7asd6Cv82OjlmpFZS/c3sFz2nbsHYDT1I2EFUVFnW',1,1);
	-->

	<div class='full-content'>
		<main data-barba='container' data-barba-namespace='home'>
			<div class="container" style="max-width: 1000px;">
				<div class='main'>

					<?php
					$is_logged = $_SESSION["is_logged"] ?? 0;
					if ($is_logged)
						echo "<h2 style='text-align: center'><p>Hello " . $_SESSION["name"] . " 🥳</p></h2>";
					?>
					<h3> Welcome to the ACQTX url shortener</h3>

					<!-- ---------------- formulaire ---------------- -->
					<form action="./" method="POST" class="form-div">
						<div class="form-group">
							<label for="url">URL to shorten : </label>
							<input type="text" name="URL" required class="form-control" id="url" placeholder='ex: https://www.google.fr/'>
							<?php
							if ($is_logged) {
								echo "<label for=custom_url>Your own shortened url (not required): </label>";
								echo "<input type=text name=custom_url class=form-control placeholder='ex: google'>";
							}
							?>
							<br>
							<div class="d-grid gap-2 col-3 mx-auto">
								<input type="submit" class="btn btn-primary" value="Shorten">
							</div>
						</div>
					</form>
					<!-- ---------------- formulaire ---------------- -->

					<?php
					$email = $_SESSION["email"] ?? null;

					// check l'url, de l'existence de l'url dans la base de donnée.
					if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["URL"])) {
						$url_to_shorten = $_POST["URL"];
						$url_exist = find_url_by_long_url($url_to_shorten, $email);
						$short_url = $url_exist[1];
						$print_short_url = false;
						echo "<h5><p>";
						if ($url_exist) {
							if ($is_logged) {
								echo "<script>$('#long_url_already_shortened').show('medium'); setTimeout(function(){ $('#long_url_already_shortened').hide('medium'); }, 5000);</script>";
								echo "This URL is already shortened: <a href=http://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</a>";
							} else {
								if ($short_url) {
									echo "<script>$('#url_shortened_success').show('medium'); setTimeout(function(){ $('#url_shortened_success').hide('medium'); }, 5000);</script>";
									echo "<h5 style='color:rgb(60, 179, 113); font-weight:bold'>Your short URL is : <a style='color:inherit' href=http://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</a></h5>";
								}
							}
						} else {
							$print_short_url = true;
							if (!empty($_POST["custom_url"])) {
								$short_url = $_POST["custom_url"];
							} else
								$short_url = generate_url($url_to_shorten);

							// si short url depasse les 20 caractères
							if (strlen($short_url) > 20) {
								echo "<script>$('#short_url_must_be_less_than_20_characters').show('medium'); setTimeout(function(){ $('#short_url_must_be_less_than_20_characters').hide('medium'); }, 5000);</script>";
							} else if (!is_pattern_url_good($short_url)) {
								echo "<script>$('#short_url_must_only_contains_letter_and_number').show('medium'); setTimeout(function(){ $('#short_url_must_only_contains_letter_and_number').hide('medium'); }, 5000);</script>";
							} else if (is_short_url_exists($short_url)) {
								// $url = find_url_by_short_url($short_url, $email);
								echo "<script>$('#short_url_already_exist').show('medium'); setTimeout(function(){ $('#short_url_already_exist').hide('medium'); }, 5000);</script>";
								$print_short_url = false;
							} else {
								if (!str_starts_with($url_to_shorten, "http://") && !str_starts_with($url_to_shorten, "https://"))
									$url_to_shorten = "http://$url_to_shorten";

								insert_url($email, $short_url, $url_to_shorten);

								echo "<script>$('#url_shortened_success').show('medium'); setTimeout(function(){ $('#url_shortened_success').hide('medium'); }, 5000);</script>";
							}
						}
						echo "</p></h5>";
						if ($short_url && $print_short_url)
							echo "<h5 style='color:rgb(60, 179, 113); font-weight:bold'>Your short URL is : <a style='color:inherit' href=http://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</a></h5>";
					}

					if ($is_logged) {
					?>
						<div class="d-flex justify-content-between align-items-center" style="margin-bottom:-15px; margin-top:10px">
							<h4 style="margin-left: 2px; margin-top: 10px">List of your URL</h4>
							<form action='./' method='POST' class='form_search'>
								<input type='text' name='search' class='form_text_input_search' placeholder='search...' />
								<input type='submit' value='Search' class='btn btn-primary form-btn btn-search' />
								<?php
								if (isset($_POST['search']) && !empty($_POST['search'])) {
									$search = $_POST['search'];
									echo "<a href='index.php' class='h-25'><input type='submit' value='Clear' class='btn btn-secondary form-btn rounded-lg color_search' /></a>";
									echo '<input type=hidden id="search" value="' . $search . '"/>';
								}
								?>
							</form>
						</div>
						<div class='table-responsive pt-3'>

							<table id=table_url class='table'>
								<thead>
									<tr>
										<th scopre=col>Short url</th>
										<th scope=col>Long url</th>
										<th scope=col>Clicks</th>
										<th scope=col>Update</th>
										<th scope=col>Delete</th>
									</tr>
								</thead>
								<tbody id='bodyOfUrlArray'>
								</tbody>
							</table>
						</div>
				</div>

			</div>

		</main>
	</div>
	<script src='index.js'></script>
<?php
						// Modal to update a url
						require_once("src/templates/modals/modalIndex/updateModal.php");

						// Modal to delete a url
						require_once("src/templates/modals/modalIndex/deleteModal.php");
					} else {
						echo "</div></div></main></div>";
					}
					require_once("src/templates/footer.php");
?>

</body>

</html>