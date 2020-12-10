<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h2 align="center">Selamat datang di halaman Admin (Siswa)</h2>

<div class="row">
    <div class="col mt-2">
        <a href="<?= base_url('addUser') ?>" class="btn btn-primary">Tambah Siswa</a>
    </div>
</div>

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

<div class="card card-body mt-2">
    <div class="row">
        <div class="col-12 col-sm-6 float-right">
            <h3>
                Jumlah siswa total: <?= ($jumlah_siswa) ? $jumlah_siswa : 0 ?>
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
    <?php if ($all_siswa == null) { ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 style="display: inline;">
                    Tidak ada Siswa.
                </h3>
            </div>
        </div>
    <?php } else { ?>
        <div class="table-responsive mt-4">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nis</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (5 * ($current_page - 1));
                    foreach ($all_siswa as $siswa) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $siswa['nis'] ?></td>
                            <td><?= $siswa['nama_user'] ?></td>
                            <td>
                                <img style="height: 90px; width: 90px;" src="<?= base_url('foto/fotoprofil/' . $siswa['foto_profil']); ?>" alt="image" class="rounded-circle">
                            </td>
                            <td>
                                <a title="Hapus Data <?= $siswa['nama_user'] ?>" href="<?= base_url('deleteUser/' . $siswa['nis']) ?>" class="mt-1 btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus Siswa ini?');"><i class="fas fa-trash-alt"></i></a>
                                <a title="Ubah Data <?= $siswa['nama_user'] ?>" href="<?= base_url('updateUser/' . $siswa['nis']) ?>" class="mt-1 btn btn-primary"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links('user', 'custom_pagination') ?>
        </div>
    <?php } ?>
</div>

<?= $this->endSection('content'); ?>