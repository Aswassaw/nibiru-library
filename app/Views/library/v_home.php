<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="jumbotron jumbotron-home">
    <h1 class="display-5" style="-webkit-text-stroke: 0.7px black;">Halo <?= $user['nama_user'] ?></h1>
    <hr>
    <p style="-webkit-text-stroke: 0.2px black;">Meminjam buku sekarang jadi lebih mudah menggunakan Nibiru Library</p>
    <a class="btn btn-primary btn-lg" href="<?= base_url('library') ?>" role="button">Ke Perpustakaan</a>
</div>

<br>
<h3 align="center">Paling Baru</h3>
<hr>
<div class="card card-body">
    <!-- Jika buku terbaru tidak ditemukan -->
    <?php if ($new_buku == null) { ?>
        <div class="card-body">
            <h3 style="display: inline;">
                Tidak ditemukan.
            </h3>
        </div>
    <?php } else { ?>
        <div class="row row-cols-1 row-cols-md-3">
            <?php foreach ($new_buku as $nbuku) { ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?= 'foto/sampulbuku/' . $nbuku['sampul_buku'] ?>" class="card-img-top" style="height:450px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <b title="<?= $nbuku['nama_buku'] ?>"><?= substr($nbuku['nama_buku'], 0, 25) ?><?php if (strlen($nbuku['nama_buku']) > 25) { ?>...<?php } ?></b>
                            </h5>
                            Status:
                            <?php if ($nbuku['status_buku'] == 1) { ?>
                                <span class="badge badge-danger">
                                    Dipinjam
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-success">
                                    Bebas
                                </span>
                            <?php } ?>
                            </b>
                            <hr>
                            - Kategori: <?= $nbuku['nama_kategori'] ?>
                            <br>
                            - Deskripsi: <?= substr($nbuku['deskripsi_buku'], 0, 50) ?><?php if (strlen($nbuku['deskripsi_buku']) > 50) { ?>...<?php } ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-primary mt-2" href="<?= base_url('detailBuku/' . $nbuku['no_buku']) ?>">Lihat Detail</a>
                                </div>
                                <div class="col">
                                    <?= $nbuku['buku-created_at'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<br>
<h3 align="center">Paling Banyak Dipinjam</h3>
<hr>
<div class="card card-body">
    <!-- Jika buku terbanyak dipinjam tidak ditemukan -->
    <?php if ($banyak_buku == null) { ?>
        <div class="card-body">
            <h3 style="display: inline;">
                Tidak ditemukan.
            </h3>
        </div>
    <?php } else { ?>
        <div class="row row-cols-1 row-cols-md-3">
            <?php foreach ($banyak_buku as $bbuku) { ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?= 'foto/sampulbuku/' . $bbuku['sampul_buku'] ?>" class="card-img-top" style="height:450px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <b title="<?= $bbuku['nama_buku'] ?>"><?= substr($bbuku['nama_buku'], 0, 25) ?><?php if (strlen($bbuku['nama_buku']) > 25) { ?>...<?php } ?></b>
                            </h5>
                            - Status:
                            <?php if ($bbuku['status_buku'] == 1) { ?>
                                <span class="badge badge-danger">
                                    Dipinjam
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-success">
                                    Bebas
                                </span>
                            <?php } ?>
                            </b>
                            <hr>
                            - Kategori: <?= $bbuku['nama_kategori'] ?>
                            <br>
                            - Deskripsi: <?= substr($bbuku['deskripsi_buku'], 0, 50) ?><?php if (strlen($bbuku['deskripsi_buku']) > 50) { ?>...<?php } ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-primary" href="<?= base_url('detailBuku/' . $bbuku['no_buku']) ?>">Lihat Detail</a>
                                </div>
                                <div class="col">
                                    Dipinjam <?= $bbuku['jumlah_dipinjam'] ?> kali
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<br>
<h3 align="center">Paling Populer</h3>
<hr>
<div class="card card-body">
    <!-- Jika buku terpopuler tidak ditemukan -->
    <?php if ($populer_buku == null) { ?>
        <div class="card-body">
            <h3 style="display: inline;">
                Tidak ditemukan.
            </h3>
        </div>
    <?php } else { ?>
        <div class="row row-cols-1 row-cols-md-3">
            <?php foreach ($populer_buku as $pbuku) { ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?= 'foto/sampulbuku/' . $pbuku['sampul_buku'] ?>" class="card-img-top" style="height:450px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <b title="<?= $pbuku['nama_buku'] ?>"><?= substr($pbuku['nama_buku'], 0, 25) ?><?php if (strlen($pbuku['nama_buku']) > 25) { ?>...<?php } ?></b>
                            </h5>
                            - Status:
                            <?php if ($pbuku['status_buku'] == 1) { ?>
                                <span class="badge badge-danger">
                                    Dipinjam
                                </span>
                            <?php } else { ?>
                                <span class="badge badge-success">
                                    Bebas
                                </span>
                            <?php } ?>
                            </b>
                            <hr>
                            - Kategori: <?= $pbuku['nama_kategori'] ?>
                            <br>
                            - Deskripsi: <?= substr($pbuku['deskripsi_buku'], 0, 50) ?><?php if (strlen($pbuku['deskripsi_buku']) > 50) { ?>...<?php } ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-primary" href="<?= base_url('detailBuku/' . $pbuku['no_buku']) ?>">Lihat Detail</a>
                                </div>
                                <div class="col">
                                    Disukai <?= $pbuku['love'] ?> user
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?= $this->endSection('content'); ?>