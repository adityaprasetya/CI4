<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Ubah Supplier</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/update_sl/<?= $supplier->id_spl ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?= $supplier->id_spl ?>">
                                <input type="hidden" name="slug_spl" value="<?= $supplier->slug_spl ?>">
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nm_spl" value="<?= $supplier->nm_spl ?>" name="nm_spl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Telepon</label>
                                    <input type="number" class="form-control" id="tl_spl" value="<?= $supplier->tl_spl ?>" name="tl_spl" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="al_spl" value="<?= $supplier->al_spl ?>" name="al_spl" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="/pages/supplier" class="btn btn-cancel">Kembali</a>
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