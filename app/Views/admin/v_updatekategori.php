<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card mt-3">
    <div class="card-header">
        <div style="font-size: 30px" align="center">Update Kategori</div>
    </div>
    <div class="card-body">
        <form action="<?= base_url('saveUpdateKategori/' . $kategori_update['id_kategori']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Form nama -->
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="hidden" name="nama_awal" value="<?= $kategori_update['nama_kategori'] ?>">
                <input type="text" name="nama" id="nama" placeholder="Nama Kategori" autocomplete="off" value="<?= set_value('nama', $kategori_update['nama_kategori']) ?>" class="form-control
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
                            Nama Kategori benar
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <small class="form-text text-muted">Masukkan Nama Kategori dengan benar</small>
                <?php } ?>
            </div>
            <hr>

            <button type="submit" class="btn btn-success">Ubah</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>