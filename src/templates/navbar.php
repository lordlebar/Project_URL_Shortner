<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/db/connexion.php";
?>

<!-- ------ Bar de navigation ------ -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="margin-bottom: 25px;">
	<div class="container-fluid">
		<a class="navbar-brand" href="/Project_URL_Shortner/" style="margin-left: 8%;">ACQTX</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 5%;">

				<?php
				echo "<li class='nav-item'><a class='nav-link' href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/>Home<span class=sr-only></span></a>";
				if (!isset($_SESSION["is_logged"])) {
					echo "<li class='nav-item'><a class=nav-link  href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/nav/login.php>Log in<span class=sr-only></span></a></li>";
					echo "<li class=nav-item><a class=nav-link href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/nav/signup.php>Sign up</a></li>";
					// echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/template/users/infos.php>Infos</a></li>";
				} else {
					if ((isset($_SESSION["is_admin"]) && ($_SESSION["is_admin"]))) {
						echo "<li class=nav-item><a class=nav-link href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/admin/adminPanel.php>Admin Panel</a></li>";
					}
					echo "<li class=nav-item><a class=nav-link href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/nav/profile.php>Profile</a></li>";
					// echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/template/users/infos.php>Infos</a></li>";
					echo "<li class=nav-item><a class=nav-link href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/nav/signout.php>Sign out</a></li>";
				}
				?>

			</ul>

		</div>
		<?php
		if ((isset($_SESSION["is_logged"]) && ($_SESSION["is_logged"]))) {
			echo "<p class='session_email'><a class=nav-link onclick='changeClass()' href=http://" . $_SERVER["HTTP_HOST"] . "/Project_URL_Shortner/src/pages/nav/profile.php>Connected as " . $_SESSION['email'] . "</a></p>";
		}
		?>
	</div>
</nav>

<!-- Transiton between pages -->
<div class='cont-bands'>
	<div class='band'></div>
	<div class='band'></div>
	<div class='band'></div>
</div>
<!-- Transiton between pages -->

<!-- button light / dark | Mode -->
<div class="theme">
	<button class="btn-toggle" onclick="changeTheme()">Theme</button>
</div>

<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Project_URL_Shortner/src/templates/alert.php";
?>