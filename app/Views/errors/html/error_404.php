<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="description" content="Aplikasi Perpustakaan Sederhana - Nibiru Library">
	<meta name="keywords" content="HTML, CSS, Javascript, PHP, CodeIgniter 4, jQuery, Nibiru Library, Andry Pebrianto, SMKN 2 Trenggalek">
	<meta name="author" content="Andry Pebrianto">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="/assets/css/font.css">
	<link rel="stylesheet" href="/assets/fontawesome/css/all.css">

	<style>
		/* Mengubah font */
		* {
			font-family: "poppinsregular", arial, sans-serif;
		}

		/* Transisi agar tidak kaku */
		body {
			transition: 0.2s;
		}

		/* Style saat mode gelap aktif */
		body.dark {
			background-color: #1c1d22;
			color: white;
		}

		/* Transisi ketika dark mode di card hilang */
		.card {
			transition: 0.2s;
		}

		/* Style untuk merubah warna card content menjadi dark */
		.card-dark {
			background-color: #2d3038;
		}
	</style>

	<title>404 - Page Not Found</title>
</head>

<body>
	<div class="container my-5">
		<div class="card">
			<div class="card-body">
				<h1 align="center">404 - Page Not Found</h1>
				<hr>
				<center>
					<img id="404" src="<?= base_url('assets/img/gambar/404-white.jpg') ?>" width="250px">
				</center>
				<hr>
			</div>
			<center>
				<?php if (session()->get('isLoggedIn')) { ?>
					<div class="row">
						<div class="col-sm">
							<h5>Back to Home</h5>
							<br>
							<a href="<?= base_url('home') ?>" class="btn btn-outline-success "><i class="fas fa-home"></i> Home</a>
							<br><br>
						</div>
						<div class="col-sm">
							<h5>Back to Library</h5>
							<br>
							<a href="<?= base_url('library') ?>" class="btn btn-outline-primary"><i class="fas fa-book"></i> Library</a>
							<br><br>
						</div>
						<div class="col-sm">
							<h5>Logout now</h5>
							<br>
							<a href="<?= base_url('logout') ?>" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
							<br><br>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
						<div class="col-sm">
							<h5>Login now</h5>
							<br>
							<a href="<?= base_url('/') ?>" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i> Login</a>
							<br><br>
						</div>
					</div>
				<?php } ?>
			</center>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script>
		// Jika pada local storage telah terdapat sebuah item dengan nama tema yang isinya adalah dark
		if (localStorage.getItem('tema') === 'dark') {
			document.body.classList.toggle('dark');
			// Tooggle untuk menambahkan class bernama bg-dark pada elemen dengan class card
			document.querySelectorAll('.card').forEach(index => index.classList.toggle('card-dark'));
			// Merubah gambar 404 yang sesuai
			document.getElementById('404').setAttribute('src', `<?= base_url('assets/img/gambar/404-black.jpg') ?>`);
		} else {

		}
	</script>

</body>

</html>