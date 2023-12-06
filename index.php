<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 'home';
}; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>App Admin</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

	<link rel="stylesheet" href="assets/custom/style.css">

	<!-- Bootstrap JS and jQuery (order matters) -->
	<script src="assets/bootstrap/js/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="assets/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d9d9d9;">
		<a class="navbar-brand" href="#">App Admin</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link <?= ($page == 'home') ? 'active' : ''; ?>" href=".">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($page == 'user') ? 'active' : ''; ?>" href="?page=user">User</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($page == 'berita') ? 'active' : ''; ?>" href="?page=berita">Berita</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($page == 'about') ? 'active' : ''; ?>" href="?page=about">About</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Content -->
	<div class="container mt-5">
		<?php include('views/' . $page . '.php'); ?>
	</div>

	<!-- Footer -->
	<footer class="bg-dark text-light text-center py-3">
		<p>&copy; <?php echo date('Y'); ?> App Admin. All rights reserved.</p>
	</footer>
</body>

</html>