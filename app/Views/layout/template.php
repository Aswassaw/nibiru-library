<?php $uri = service('uri'); ?>

<!doctype html>
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
    <link rel="stylesheet" href="/assets/dropify/dist/css/dropify.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/font.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.css">

    <title><?= $title ?></title>
</head>

<body>

    <!-- Memanggil Navbar -->
    <?= $this->include('layout/v_navbar'); ?>

    <!-- Switch dark mode -->
    <div class="dark-mode">
        <center>
            <!-- Button Mode Gelap -->
            <div class="custom-control custom-switch wadah-tema-mode">
                <input type="checkbox" class="custom-control-input" id="tema-mode">
                <label class="custom-control-label" for="tema-mode">Light</label>
            </div>
        </center>
    </div>

    <!-- Memanggil Content -->
    <div class="container my-2 mb-4">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Jika user sudah login -->
    <?php if (session()->get('isLoggedIn')) { ?>

        <!-- Memanggil Footer -->
        <?= $this->include('layout/v_footer'); ?>
    <?php } ?>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="/assets/js/manipulate.js"></script>
    <script src="/assets/js/event.js"></script>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="/assets/dropify/dist/js/dropify.js"></script>
    <script src="/assets/dropify/dist/js/dropify.min.js"></script>
    <script src="/assets/js/dropify.js"></script>

</body>

</html>