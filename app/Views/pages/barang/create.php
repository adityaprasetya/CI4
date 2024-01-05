<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Tambah Barang</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/save" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nm_brg')) ? 'is-invalid' : '' ?>" id="nm_brg" name="nm_brg">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nm_brg') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="hrg" name="hrg">
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="stk" name="stk">
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="sat" name="sat">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                                <a href="/pages/barang" class="btn btn-cancel mt-2">Kembali</a>
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