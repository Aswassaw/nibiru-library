<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 align="center">Selamat datang di halaman Buku Saya</h2>

<!-- Jika ada pesan berhasil -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success mt-2" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Jika ada pesan gagal -->
<?php if (session()->getFlashdata('danger')) : ?>
    <div class="alert alert-danger mt-2" role="alert">
        <?= session()->getFlashdata('danger') ?>
    </div>
<?php endif; ?>

<div class="card card-body mt-3">
    <div class="row">
        <div class="col-12 col-sm-6 float-right mt-2">
            <form style="display: inline;" action="" method="post">
                <select name="kategori" id="kategori" class="form-control">
                    <option value="Tidak">Tanpa Kategori</option>
                    <?php foreach ($kategori as $ktg) { ?>
                        <option <?= $ktg['nama_kategori'] == session()->get('kategori_mybook') ? 'selected=selected' : null ?> value="<?= $ktg['nama_kategori'] ?>"><?= $ktg['nama_kategori'] ?></option>
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
    <!-- Jika tidak ada user sama sekali -->
    <?php if ($buku_pinjam == null) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 style="display: inline;">
                    Anda belum meminjam Buku apapun.
                </h3>
            </div>
        </div>
    <?php } else { ?>
        <div class="table-responsive mt-4">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Buku</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Tanggal<div style="display: inline; opacity: 0;">_</div>Peminjaman</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (5 * ($current_page - 1));
                    foreach ($buku_pinjam as $buku) { ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $buku['no_buku'] ?></td>
                            <td title="<?= $buku['nama_buku'] ?>"><?= substr($buku['nama_buku'], 0, 40) ?><?php if (strlen($buku['nama_buku']) > 40) { ?>...<?php } ?></td>
                            <td>
                                <img style="height: 90px; width:65px;" src="<?= base_url('foto/sampulbuku/' . $buku['sampul_buku']) ?>" alt="image">
                            </td>
                            <td><?= $buku['tanggal_pinjam'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" title="Kembalikan Buku <?= $buku['nama_buku'] ?>" href="<?= base_url('kembalikanBuku/' . $buku['no_buku']) ?>" onclick="return confirm('Apakah anda yakin ingin mengembalikan Buku ini?');"><i class="fas fa-backward"></i> Kembalikan Buku</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" title="Detail Buku <?= $buku['nama_buku'] ?>" href="<?= base_url('detailBuku/' . $buku['no_buku']) ?>"><i class="fas fa-info-circle"></i> Detail Buku</a>
                                    </div>
                                </div>
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