<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3" align="center">Selamat datang di halaman Admin</h2>
<hr>

<div class="card card-body">
    <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><b><i class="fas fa-user"></i> Data Siswa</b></h5>
                    <hr>
                    <p class="card-text"><?= $jumlah['siswa'] ?> Siswa terdaftar</p>
                    <a class="btn btn-primary" href="<?= base_url('user') ?>">Atur</a>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><b><i class="fas fa-book"></i> Data Buku</b></h5>
                    <hr>
                    <p class="card-text"><?= $jumlah['buku'] ?> Buku ditemukan</p>
                    <a class="btn btn-primary" href="<?= base_url('book') ?>">Atur</a>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><b><i class="fas fa-list-ul"></i> Data Kategori</b></h5>
                    <hr>
                    <p class="card-text"><?= $jumlah['kategori'] ?> Kategori tersedia</p>
                    <a class="btn btn-primary" href="<?= base_url('kategori') ?>">Atur</a>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><b><i class="fas fa-hand-point-left"></i> Data Peminjaman</b></h5>
                    <hr>
                    <p class="card-text"><?= $jumlah['peminjaman'] ?> Peminjaman ditemukan</p>
                    <a class="btn btn-primary" href="<?= base_url('peminjaman') ?>">Atur</a>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><b><i class="fas fa-hand-point-right"></i> Data Pengembalian</b></h5>
                    <hr>
                    <p class="card-text"><?= $jumlah['pengembalian'] ?> Pengembalian ditemukan</p>
                    <a class="btn btn-primary" href="<?= base_url('pengembalian') ?>">Atur</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>