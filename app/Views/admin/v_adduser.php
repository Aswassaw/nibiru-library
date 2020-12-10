<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Tambah Siswa Baru</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveAddUser') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Form nis -->
            <div class="form-group">
                <label for="nis">Nomor Induk Siswa</label>
                <input type="text" name="nis" id="nis" placeholder="Nomor Induk Siswa" autocomplete="off" value="<?= set_value('nis') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('nis')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="10">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('nis')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nis') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Nomor Induk Siswa benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Nomor Induk Siswa dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form nama siswa -->
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Siswa" autocomplete="off" value="<?= set_value('nama') ?>" class="form-control
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
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" value="<?= set_value('tanggal_lahir') ?>" class="form-control
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

            <div class="form-group">
                <p>
                    <label for="foto">Foto Siswa (Opsional)</label>
                    <br>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUploadFoto" aria-expanded="false" aria-controls="collapseUploadFoto">
                        Upload Foto Siswa
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
                        <input type="file" class="custom-file-input fas dropify" data-height="150" name="foto" id="foto">
                    </div>
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
                            <?php } ?>" required minlength="8" maxlength="450">

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
                    <small class="form-text text-muted">Masukkan Password dengan benar</small>
                <?php } ?>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input show-password no-check" id="show-password">
                <label class="form-check-label show-password" for="show-password"> <i class="fas fa-eye"></i> Show Password</label>
            </div>
            <hr>

            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>