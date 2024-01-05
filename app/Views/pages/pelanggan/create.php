<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Tambah Pelanggan</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/save_pl" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nm_brg')) ? 'is-invalid' : '' ?>" id="nm_plg" name="nm_plg">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nm_plg') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="jn_klm" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jn_klm" name="jn_klm">
                                </div>
                                <div class="mb-3">
                                    <label for="tlp" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="tlp" name="tlp">
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="almt" name="almt">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                                <a href="/pages/pelanggan" class="btn btn-cancel mt-2">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endsection(); ?>