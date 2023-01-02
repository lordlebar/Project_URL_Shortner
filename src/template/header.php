<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="/Projet_Lamp_EXP2/" style="margin-left: 8%;">ACQTX</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: 5%;">

					<?php
					session_start();

					echo "<li class='nav-item active'><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/>Home<span class=sr-only></span></a>";
					if (!$_SESSION["is_logged"]) {
						echo "<li class='nav-item active'><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/login.php>Login<span class=sr-only></span></a></li>";
						echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/signup.php>Sign up</a></li>";
					} else {
						if ($_SESSION["is_admin"]) {
							echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/admin/adminPanel.php>Admin Panel</a></li>";
						}
						echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/profile.php>Profile</a></li>";
						echo "<li class=nav-item><a class=nav-link href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/signout.php>Sign out</a></li>";
					}
					?>

				</ul>

			</div>
			<?php
			if ($_SESSION["is_logged"]) {
				echo "<p class='session_email'><a href=https://" . $_SERVER["HTTP_HOST"] . "/Projet_Lamp_EXP2/src/template/users/profile.php>Connected as " . $_SESSION['email'] . "</a></p>";
			}
			?>
		</div>
	</nav>
	<div style="height:25px"></div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</header>