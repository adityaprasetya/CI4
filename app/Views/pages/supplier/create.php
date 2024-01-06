<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Tambah Supplier</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/save_sl" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nama Supplier</label>
                                    <input type="text" class="form-control" id="nm_spl" name="nm_spl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tlp" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="tl_spl" name="tl_spl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="al_spl" name="al_spl" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                                <a href="/pages/supplier" class="btn btn-cancel mt-2">Kembali</a>
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