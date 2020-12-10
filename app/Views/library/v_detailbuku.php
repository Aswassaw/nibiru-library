<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3" align="center">Detail buku untuk <?= $buku['nama_buku'] ?></h2>

<!-- Jika ada pesan berhasil -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success mt-2" role="alert">
        <?= session()->getFlashdata('success') ?> Lihat<a href="<?= base_url('myBook') ?>"> Buku Saya</a>
    </div>
<?php endif; ?>

<!-- Jika ada pesan gagal -->
<?php if (session()->getFlashdata('danger')) : ?>
    <div class="alert alert-danger mt-2" role="alert">
        <?= session()->getFlashdata('danger') ?>
    </div>
<?php endif; ?>

<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img style="height:500px;" src="<?= base_url('foto/sampulbuku/' . $buku['sampul_buku']) ?>" class="card-img" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><b><?= $buku['nama_buku'] ?></b></h5>
                <p>Status:<b>
                        <?php if ($buku['status_buku'] == 1) { ?>
                            <span class="badge badge-danger">
                                Dipinjam
                            </span>
                        <?php } else { ?>
                            <span class="badge badge-success">
                                Bebas
                            </span>
                        <?php } ?>
                    </b></p>
                <hr>

                <p class="card-text">Pengarang: <b><?= $buku['pengarang_buku'] ?></b></p>
                <p class="card-text">Penerbit: <b><?= $buku['penerbit_buku'] ?></b></p>
                <p class="card-text">Kategori: <b><?= $buku['nama_kategori'] ?></b></p>
                <p class="card-text">Deskripsi: <b><?= $buku['deskripsi_buku'] ?></b></p>
                <!-- Jika admin mengunjungi halaman ini -->
                <?php if ($user['jabatan'] != 1) { ?>
                    <!-- Jika ada yang meminjam -->
                    <?php if ($peminjam != null) { ?>
                        <!-- Jika peminjamnya adalah user ini sendiri -->
                        <?php if ($peminjam['nis_bukupinjam'] == $user['nis']) { ?>
                            <button class="btn btn-primary" disabled>Anda Meminjam Buku Ini</button>
                        <?php } else { ?>
                            <button class="btn btn-danger" disabled>Seseorang Meminjam Buku Ini</button>
                        <?php } ?>
                    <?php } else { ?>
                        <a class="btn btn-success" href="<?= base_url('pinjamBuku/' . $buku['no_buku']) ?>" onclick="return confirm('Apakah anda yakin ingin meminjam Buku ini?');">Pinjam Buku</a>
                    <?php } ?>
                    <!-- Tombol Like -->
                    <?php if ($sudah_like == true) { ?>
                        <a href="<?= base_url('likeBuku/' . $buku['no_buku']) ?>" class="btn btn-primary"><i class="fas fa-thumbs-up" title="Batalkan Menyukai"> <?= $buku['love'] ?></i></a>
                    <?php } else { ?>
                        <a href="<?= base_url('likeBuku/' . $buku['no_buku']) ?>" class="btn btn-secondary"><i class="fas fa-thumbs-up" title="Sukai Buku Ini"> <?= $buku['love'] ?></i></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>