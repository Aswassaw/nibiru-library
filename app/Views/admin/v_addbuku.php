<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Tambah Buku Baru</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveAddBuku') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
                    <!-- Form no_buku -->
            <div class="form-group">
                <label for="no_buku">No Buku</label>
                <input type="text" name="no_buku" id="no_buku" placeholder="No Buku" autocomplete="off" value="<?= set_value('no_buku') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('no_buku')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="10">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('no_buku')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_buku') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            No Buku benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan No Buku dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form nama buku -->
            <div class="form-group">
                <label for="nama">Nama Buku</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Buku" autocomplete="off" value="<?= set_value('nama') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('nama')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="150">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('nama')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Nama Buku benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Nama Buku dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form pengarang -->
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" id="pengarang" placeholder="Pengarang" autocomplete="off" value="<?= set_value('pengarang') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('pengarang')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="150">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('pengarang')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pengarang') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Pengarang benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Pengarang dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form penerbit -->
            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" placeholder="Penerbit" autocomplete="off" value="<?= set_value('penerbit') ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('penerbit')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="100">

                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('penerbit')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('penerbit') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Penerbit benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Penerbit dengan benar</small>
                <?php } ?>
            </div>

            <div class="form-group">
                <p>
                    <label for="sampul">Sampul (Opsional)</label>
                    <br>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUploadSampul" aria-expanded="false" aria-controls="collapseUploadSampul">
                        Upload Sampul Buku
                    </button>
                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('sampul')) { ?>
                            <small style="color: #dc3545;" class="form-text">
                                <?= $validation->getError('sampul') ?>
                            </small>
                        <?php } else { ?>
                            <small style="color:#28a745;" class="form-text">
                                Sampul Buku benar
                            </small>
                        <?php } ?>
                    <?php } else { ?>
                        <small class="form-text text-muted">Masukkan Sampul Buku dengan benar</small>
                    <?php } ?>
                </p>
                <div class="collapse" id="collapseUploadSampul">
                    <!-- Form upload sampul -->
                    <div class="form-group">
                        <input type="file" class="custom-file-input fas dropify" data-height="150" name="sampul" id="sampul">
                    </div>
                </div>
            </div>

            <!-- Select kategori -->
            <div class="form-group">
                <label for="kategori">Kategori Buku</label>
                <select name="kategori" id="kategori" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('kategori')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required>

                    <?php foreach ($kategori as $ktg) { ?>
                        <option value="<?= $ktg['nama_kategori'] ?>"><?= $ktg['nama_kategori'] ?></option>
                    <?php } ?>
                </select>
                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('kategori')) { ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori') ?>
                        </div>
                    <?php } else { ?>
                        <div class="valid-feedback">
                            Kategori benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Pilih Kategori dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form deskripsi buku -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" cols="70" rows="5" placeholder="Deskripsi buku" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('deskripsi')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" maxlength="450"><?= set_value('deskripsi') ?></textarea>

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

            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>