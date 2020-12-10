<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Update Siswa</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveUpdateUser/' . $user_update['nis']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Form nama siswa -->
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Siswa" autocomplete="off" value="<?= set_value('nama', $user_update['nama_user']) ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('nama')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="100">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('nama')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Nama Siswa benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Nama Siswa dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form tanggal lahir -->
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" value="<?= set_value('tanggal_lahir', $user_update['tanggal_lahir']) ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('tanggal_lahir')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="100">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('tanggal_lahir')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('tanggal_lahir') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Tanggal Lahir benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Tanggal Lahir dengan benar</small>
                <?php } ?>
            </div>

            <p>
                <label for="nama">Foto Siswa (Opsional)</label>
                <br>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUploadFoto" aria-expanded="false" aria-controls="collapseUploadFoto">
                    Upload Foto
                </button>
                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('foto')) { ?>
                        <small style="color: #dc3545;" class="form-text">
                            <?= $validation->getError('foto') ?>
                        </small>
                    <?php } else { ?>
                        <small style="color:#28a745;" class="form-text">
                            Foto Siswa benar
                        </small>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Foto Siswa dengan benar</small>
                <?php } ?>
            </p>
            <div class="collapse" id="collapseUploadFoto">
                <!-- Form upload foto -->
                <div class="form-group">
                    <input type="file" class="custom-file-input fas dropify" data-default-file="<?= base_url('foto/fotoprofil/' . $user_update['foto_profil']) ?>" data-height="150" name="foto" id="foto">
                </div>
            </div>

            <!-- Form password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" value="<?= set_value('password') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('password')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" minlength="8" maxlength="450">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('password')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Password benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Kosongkan Password jika tidak ingin merubahnya</small>
                <?php } ?>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input show-password no-check" id="show-password">
                <label class="form-check-label show-password" for="show-password"> <i class="fas fa-eye"></i> Show Password</label>
            </div>
            <hr>

            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>