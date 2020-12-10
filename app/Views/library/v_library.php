<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 align="center" class="mb-3">Selamat datang di halaman Perpustakaan</h2>
<hr>

<div class="row mb-3">
    <div class="col-12 col-sm-6 float-right mt-2">
        <form style="display: inline;" action="" method="post">
            <select name="kategori" id="kategori" class="form-control">
                <option value="Tidak">Tanpa Kategori</option>
                <?php foreach ($kategori as $ktg) { ?>
                    <option <?= $ktg['nama_kategori'] == session()->get('kategori_library') ? 'selected=selected' : null ?> value="<?= $ktg['nama_kategori'] ?>"><?= $ktg['nama_kategori'] ?></option>
                <?php } ?>
            </select>
            <button id="ketegori-submit" style="display:none;" type="submit"></button>
        </form>
    </div>
    <div class="col-12 col-sm-6 float-right mt-2">
        <form class="" action="" method="get">
            <div class="input-group">
                <input type="text" class="form-control" value="<?= (isset($_GET['keyword'])) ? $_GET['keyword'] : null ?>" name="keyword" placeholder="Masukkan Kata Kunci Pencarian" maxlength="100" autocomplete="off" autofocus>
                <div class="input-group-append">
                    <input class="btn btn-success fas" type="submit" value="Cari">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-body">
    <!-- Jika tidak ada buku sama sekali -->
    <?php if ($all_buku == null) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 style="display: inline;">
                    Tidak ada buku.
                </h3>
            </div>
        </div>
    <?php } else { ?>
        <div class="row row-cols-1 row-cols-md-3">
            <?php foreach ($all_buku as $buku) { ?>
                <div class="col mb-4">
                    <div class="card h-100">
                        <img src="<?= 'foto/sampulbuku/' . $buku['sampul_buku'] ?>" class="card-img-top" style="height:450px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <b title="<?= $buku['nama_buku'] ?>"><?= substr($buku['nama_buku'], 0, 25) ?><?php if (strlen($buku['nama_buku']) > 25) { ?>...<?php } ?></b>
                            </h5>
                            - Status:
                            <?php if ($buku['status_buku'] == 1) { ?>
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
                            - Kategori: <?= $buku['nama_kategori'] ?>
                            <br>
                            - Deskripsi: <?= substr($buku['deskripsi_buku'], 0, 50) ?><?php if (strlen($buku['deskripsi_buku']) > 50) { ?>...<?php } ?>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary" href="<?= base_url('detailBuku/' . $buku['no_buku']) ?>">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?= $pager->links('buku', 'custom_pagination') ?>
    <?php } ?>
</div>

<?= $this->endSection('content'); ?>