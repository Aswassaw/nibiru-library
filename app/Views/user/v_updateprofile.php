<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Update Siswa</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveUpdateProfile') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Form nama siswa -->
            <div class="form-group">
                <label for="nama">Nama Siswa</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Siswa" autocomplete="off" value="<?= set_value('nama', $user['nama_user']) ?>" class="form-control
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
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" autocomplete="off" value="<?= set_value('tanggal_lahir', $user['tanggal_lahir']) ?>" class="form-control
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

            <!-- Form deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" cols="70" rows="5" placeholder="Deskripsi" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('deskripsi')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" maxlength="450"><?= set_value('deskripsi', $user['deskripsi']) ?></textarea>

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('deskripsi')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Deskripsi benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Deskripsi dengan benar</small>
                <?php } ?>
            </div>
            <hr>

            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>