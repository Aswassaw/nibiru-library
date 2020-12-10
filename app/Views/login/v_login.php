<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div align="center" class="login-title">FORM LOGIN</div>
                <hr>
                <form action="" method="post">
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
                        <?php } ?>" required>

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
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="col">
                            <button type="reset" class="btn btn-danger btn-block reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>