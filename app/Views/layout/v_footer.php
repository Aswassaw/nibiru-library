<!-- Footer -->
<footer style="color:white;" class="page-footer font-small blue pt-4 bg-dark">
    <div class="container">
        <div class="container-fluid text-center text-md-left mt-4">
            <div class="row">

                <div class="col-md-6 mt-md-0 mt-3">
                    <!-- Content -->
                    <h5><img src="<?= base_url('assets/img/logo/logo50px.webp') ?>" height="50px" width="50px"> Nibiru Library</h5>
                    <p>Meminjam buku sekarang jadi lebih mudah menggunakan Nibiru Library</p>
                </div>

                <hr class="clearfix w-100 d-md-none pb-3">

                <div class="col-md-3 mb-md-0 mb-3">
                    <h5>Kategori Buku</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($kategori_footer as $ktgr) { ?>
                            <li>
                                <a href="<?= base_url('kategoriCepat/' . $ktgr['nama_kategori']) ?>"><?= $ktgr['nama_kategori'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="col-md-3 mb-md-0 mb-3">
                    <h5>Jalan Pintas</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?= base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= base_url('library') ?>">Library</a>
                        </li>
                        <li>
                            <a href="<?= base_url('profile') ?>">Profile</a>
                        </li>
                        <li>
                            <!-- Jika user sudah login -->
                            <?php if ($user['jabatan'] == 1) { ?>
                                <a href="<?= base_url('admin') ?>">Admin</a>
                            <?php } else { ?>
                                <a href="<?= base_url('myBook') ?>">My Book</a>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="<?= base_url('logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-copyright text-center py-3">
            <hr>
            © 2020 Copyright:
            <a href="https://web.facebook.com/andry.pebrianto/" target="_blank">
                Andry Pebrianto
            </a>
        </div>
    </div>
</footer>