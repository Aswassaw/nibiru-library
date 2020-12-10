<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Update Buku</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveUpdateBuku/' . $buku_update['no_buku']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Form nama buku -->
            <div class="form-group">
                <label for="nama">Nama Buku</label>
                <input type="text" name="nama" id="nama" placeholder="Nama Buku" autocomplete="off" value="<?= set_value('nama', $buku_update['nama_buku']) ?>" class="form-control
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
                            Nama Buku benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Nama Siswa dengan benar</small>
                <?php } ?>
            </div>

            <!-- Form pengarang -->
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" id="pengarang" placeholder="Pengarang" autocomplete="off" value="<?= set_value('pengarang', $buku_update['pengarang_buku']) ?>" class="form-control
                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('pengarang')) { ?>
                                    is-invalid
                                <?php } else { ?>
                                    is-valid
                                <?php } ?>
                            <?php } ?>" required maxlength="100">

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
                <input type="text" name="penerbit" id="penerbit" placeholder="Penerbit" autocomplete="off" value="<?= set_value('penerbit', $buku_update['penerbit_buku']) ?>" class="form-control
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

            <p>
                <label for="nama">Sampul (Opsional)</label>
                <br>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseUploadSampul" aria-expanded="false" aria-controls="collapseUploadSampul">
                    Upload Sampul
                </button>
                <?php if (isset($validation)) { ?>
                    <?php if ($validation->hasError('sampul')) { ?>
                        <small style="color: #dc3545;" class="form-text">
                            <?= $validation->getError('sampul') ?>
                        </small>
                    <?php } else { ?>
                        <small style="color:#28a745;" class="form-text">
                            Sampul benar
                        </small>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Sampul dengan benar</small>
                <?php } ?>
            </p>
            <div class="collapse" id="collapseUploadSampul">
                <!-- Form upload sampul -->
                <div class="form-group">
                    <input type="file" class="custom-file-input fas dropify" data-default-file="<?= base_url('foto/sampulbuku/' . $buku_update['sampul_buku']) ?>" data-height="150" name="sampul" id="sampul">
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
                        <option <?= $ktg['nama_kategori'] == $buku_update['nama_kategori'] ? 'selected=selected' : null ?> value="<?= $ktg['nama_kategori'] ?>"><?= $ktg['nama_kategori'] ?></option>
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
                            <?php } ?>" maxlength="450"><?= set_value('deskripsi', str_replace('<br />', '', $buku_update['deskripsi_buku'])) ?></textarea>

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