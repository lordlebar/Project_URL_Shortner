<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Projet LAMP EXP2">
	<title>Projet LAMP EXP2</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php
	require_once("src/initialize.php");
	require_once("src/template/header.php");
	?>
	<div>
		<div class="col-lg-10" style='margin:0 auto'>
			<article class='main'>
				<?php
				$is_logged = $_SESSION["is_logged"] ?? 0;
				if ($is_logged)
					echo "<h2 style='text-align: center'><p>Hello " . $_SESSION["name"] . "🥳</p></h2>";
				?>
				<h3 style="text-align: center"> Welcome to the ACQTX url shortener</h3>
				<form action="./" method="POST">
					<div class="form-group">
						<label for="url">URL to shorten : </label>
						<input type="text" name="URL" required class="form-control" id="url">
						<?php
						if ($is_logged) {
							echo "<label for=custom_url>Your own shortened url (not required): </label>";
							echo "<input type=text name=custom_url class=form-control>";
						}
						?>
						<br>
						<div class="d-grid gap-2 col-3 mx-auto">
							<input type="submit" class="btn btn-primary" value="Shorten">
						</div>
					</div>
				</form>
				<?php
				$email = $_SESSION["email"] ?? null;
				if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["URL"])) {
					$url_to_shorten = $_POST["URL"];
					$url_exist = find_url_by_long_url($url_to_shorten, $email);
					$short_url = $url_exist[1];
					echo "<h5><p>";
					if ($url_exist) {
						if ($is_logged) {
							$url = find_url_by_short_url($short_url, $email);
							echo "This URL is already shortened: <a href=https://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</a>";
						} else {
							if ($short_url)
								echo "<h5 style='color:rgb(60, 179, 113); font-weight:bold'>Your short URL is : <a style='color:inherit' href=https://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</h5>";
						}
					} else {
						$print_short_url = true;
						if (!empty($_POST["custom_url"]))
							$short_url = $_POST["custom_url"];
						else
							$short_url = generate_url($url_to_shorten);

						if (!is_pattern_url_good($short_url)) {
							echo "Short URL must only contains letter and number";
							$short_url = null;
						} else if (is_short_url_exists($short_url, $email)) {
							$url = find_url_by_short_url($short_url, $email);
							echo "The short URL already exists to go to the site: <a href=$url[1]>$url[1]</a>";
							$print_short_url = false;
						} else {
							if (!str_starts_with($url_to_shorten, "http://") && !str_starts_with($url_to_shorten, "https://"))
								$url_to_shorten = "http://$url_to_shorten";

							insert_url($email, $short_url, $url_to_shorten);
						}
					}
					echo "</p></h5>";
					if ($short_url && $print_short_url)
						echo "<h5 style='color:rgb(60, 179, 113); font-weight:bold'>Your short URL is : <a style='color:inherit' href=https://" . $_SERVER["HTTP_HOST"] . "/$short_url > " . $_SERVER["HTTP_HOST"] . "/$short_url</h5>";
				}
				if ($is_logged) {
					$urls = get_all_url_by_email($email);
					if ($urls->num_rows != 0) {
						echo "<div class='table-responsive'><table id=table_url class='table'><thead><tr><th scope=col>Short url</th><th scopre=col>Long url</th><th scope=col>Clicks</th><th scope=col>Update</th><th scope=col>Delete</th></tr></thead><tbody>";
						while ($row = $urls->fetch_assoc()) {
							echo "<tr>";
							$short_url = $row["short_url"];
							$td_short_url = "<a href=https://" . $_SERVER["HTTP_HOST"] . "/$short_url>" . $_SERVER["HTTP_HOST"] . "/$short_url</a>";

							$long_url = $row["long_url"];
							$mem_long_url = $long_url;
							// remove http or https from long url
							if (str_starts_with($long_url, "http://"))
								$long_url = substr($long_url, 7);
							else if (str_starts_with($long_url, "https://"))
								$long_url = substr($long_url, 8);

							$td_long_url = "<a href=$mem_long_url>$long_url</a>";

							echo "<td>$td_short_url</td>
									<td>$td_long_url</td>
									<td>" . $row["nb_click"] . "</td>";

							// update button
							echo "<td><form action=./ method=POST>
									<input type=submit class='btn btn-warning' value=\"Update short url\">
										<input class='input_update_url' type=text name=update value=''>
											<input type=hidden name=update_hidden value=$short_url></form></td>";

							if (isset($_POST["update"]) && $_POST["update_hidden"] == $short_url) {
								$modify_url = $_POST["update"];

								echo "<h5><p>";

								if (!is_pattern_url_good($modify_url)) {
									echo "Short URL must only contains letter and number";
									$modify_url = null;
								} else if (is_short_url_exists($modify_url, $email)) {
									$url = find_url_by_short_url($modify_url, $email);
									echo "The short URL already exists to go to the site: " . $url[1];
								} else {
									update_short_url($short_url, $modify_url, $email);
									// refresh page javascript
									echo "<script>location.reload();</script>";
								}

								echo "</div></p></h5>";
							}

							// delete button
							echo "<td><form action=./ method=POST>  
									<input type=submit class='btn btn-danger' value=Delete name=delete>
										<input type=hidden name=delete value=$short_url></form></td>";

							if (isset($_POST["delete"]) && $_POST["delete"] == $short_url) {
								delete_url($short_url, $email);
								echo "<script>location.reload();</script>";
							}

							echo "</tr>";
						}
						echo "</tbody></table>";
					}
				}

				?>
			</article>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		});
	</script>
</body>

</html>