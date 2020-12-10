<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Jika ada pesan berhasil -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success mt-2" role="alert">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Jika ada pesan gagal -->
<?php if (isset($validation)) { ?>
    <div id="foto-validation" style="display: none;">
        <?= $validation->listErrors() ?>
    </div>
    <div class="alert alert-danger mt-2" role="alert"></div>
<?php } ?>

<div class="card">
    <div class="row no-gutters">
        <!-- Bagian Kiri -->
        <div class="col-md-6 my-3">
            <center>
                <h3><?= $user['nama_user'] ?></h3>
                <hr>
                <img src="<?= 'foto/fotoprofil/' . $user['foto_profil'] ?>" width="320" height="320" class="rounded-circle shadow">

                <br><br><br>

                <!-- Button Ubah foto profil -->
                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalFoto">
                    <i class="fas fa-edit"></i> Ubah Foto
                </button>
            </center>
        </div>
        <!-- Bagian Kanan -->
        <div class="col-md-6 my-3">
            <center>
                <h3>Data Diri Anda</h3>
                <hr>
            </center>
            <div class="card-body">
                <p class="card-text"><?php if ($user['jabatan'] == 1) { ?>
                        Nomor Induk Petugas:
                    <?php } else { ?>
                        Nomor Induk Siswa:
                    <?php } ?>
                    <br>
                    <strong><?= $user['nis'] ?></strong>
                </p>
                <p class="card-text">Nama:
                    <br>
                    <strong><?= $user['nama_user'] ?></strong>
                </p>
                <p class="card-text">Tanggal Lahir:
                    <br>
                    <strong><?= $user['tanggal_lahir'] ?></strong>
                </p>
                <p class="card-text">Deskripsi:
                    <br>
                    <strong><?= $user['deskripsi'] ?></strong>
                </p>

                <!-- Button Ubah foto profil -->
                <a href="<?= base_url('updateProfile') ?>" class="btn btn-success mt-3 mb-3">
                    <i class="fas fa-edit"></i> Ubah Data Diri
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengganti foto profil -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="judulModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Ganti Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("updateFotoUser") ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input style="font-size: 1px;" type="file" class="custom-file-input dropify" data-height="230" name="foto" id="foto" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batalkan</button>
                <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Ubah Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>