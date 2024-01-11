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
                            <?= csrf_field(); ?>
                            <form action="/pages/save" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nm_brg" name="nm_brg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_spl" class="form-label">Nama Supplier</label>
                                    <select name="id_spl" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($supplier as $s) :  ?>
                                            <option value="<?= $s->id_spl ?>"><?= $s->nm_spl ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" id="hrg" name="hrg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stk" name="stk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Satuan</label>
                                    <select name="sat" class="form-select" aria-label="Default select example">
                                        <option>Open this select menu</option>
                                        <option selected value="Pcs">Pcs</option>
                                        <option value="ltr">ltr</option>
                                        <option value="Kg">Kg</option>
                                        <option value="gr">gr</option>
                                        <option value="cm">cm</option>
                                        <option value="m">m</option>
                                    </select>
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