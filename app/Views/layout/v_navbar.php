<?php $uri = service('uri'); ?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/img/logo/logo50px.webp') ?>" height="35px" width="35px">
            <span class="navbar-brand ml-1">Nibiru Library</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if (session()->get('isLoggedIn')) { ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($uri->getSegment(1)) == 'home' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('home') ?>">Home</a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1)) == 'library' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('library') ?>">Library</a>
                    </li>
                    <?php if ($user['jabatan'] == 1) { ?>
                        <li class="nav-item <?= ($uri->getSegment(1)) == 'admin' ? 'active' : null ?>">
                            <a class="nav-link" href="<?= base_url('admin') ?>">Admin</a>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= base_url('foto/fotoprofil/' . $user['foto_profil']) ?>" alt="image" class="rounded-circle" height="30px" width="30px">
                            <p style="display: inline;" id="nav-name"><?= $user['nama_user'] ?></p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('profile') ?>">
                                <img src="<?= base_url('foto/fotoprofil/' . $user['foto_profil']) ?>" alt="image" class="rounded-circle" height="55px" width="55px"> <?= $user['nama_user'] ?>
                            </a>
                            <?php if ($user['jabatan'] != 1) { ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('myBook') ?>"><i class="fas fa-book"></i> My Book</a>
                            <?php } ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="navbar-nav">
                    <li class="nav-item <?= ($uri->getSegment(1)) == '' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('/') ?>">Login</a>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>