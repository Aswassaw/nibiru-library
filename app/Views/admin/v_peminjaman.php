<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 align="center">Selamat datang di halaman Admin (Peminjaman)</h2>

<div class="card card-body mt-3">
    <div class="row">
        <div class="col-12 col-sm-6 float-right">
            <h3>
                Jumlah buku total: <?= ($jumlah_peminjaman) ? $jumlah_peminjaman : 0 ?>
            </h3>
        </div>
        <div class="col-12 col-sm-6 float-right">
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
    <!-- Jika tidak ada user sama sekali -->
    <?php if ($peminjaman == null) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 style="display: inline;">
                    Tidak ada Buku.
                </h3>
            </div>
        </div>
    <?php } else { ?>
        <div class="table-responsive mt-4">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama<div style="display: inline; opacity: 0;">_</div>Siswa</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama<div style="display: inline; opacity: 0;">_</div>Buku</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Tanggal<div style="display: inline; opacity: 0;">_</div>Peminjaman</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (5 * ($current_page - 1));
                    foreach ($peminjaman as $pinjam) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pinjam['nama_user'] ?></td>
                            <td>
                                <img style="height: 90px; width: 90px;" src="<?= base_url('foto/fotoprofil/' . $pinjam['foto_profil']); ?>" alt="image" class="rounded-circle">
                            </td>
                            <td title="<?= $pinjam['nama_buku'] ?>"><?= substr($pinjam['nama_buku'], 0, 40) ?><?php if (strlen($pinjam['nama_buku']) > 40) { ?>...<?php } ?></td>
                            <td>
                                <img style="height: 90px; width:65px;" src="<?= base_url('foto/sampulbuku/' . $pinjam['sampul_buku']) ?>" alt="image">
                            </td>
                            <td><?= $pinjam['tanggal_pinjam'] ?></td>
                            <td>
                                <a target="_blank" title="Cetak Laporan Peminjaman Ini" href="<?= base_url('cetakLaporanPeminjaman/' . $pinjam['id_bukupinjam']) ?>" class="mt-1 btn btn-primary"><i class="fas fa-file-pdf"></i> Cetak</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links('bukupinjam', 'custom_pagination') ?>
        </div>
    <?php } ?>
</div>

<?= $this->endSection('content'); ?>