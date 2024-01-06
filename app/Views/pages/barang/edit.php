<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Ubah Barang</h5>
                    <div class="card">
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <form action="/pages/update/<?= $barang->id_brg ?>" method="post">
                                <input type="hidden" name="id" value="<?= $barang->id_brg ?>">
                                <input type="hidden" name="slug" value="<?= $barang->slug ?>">
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nm_brg" value="<?= $barang->nm_brg ?>" name="nm_brg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga (Rp)</label>
                                    <input type="number" class="form-control" id="hrg" value="<?= $barang->hrg ?>" name="hrg" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stk" value="<?= $barang->stk ?>" name="stk" required>
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
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <a href="/pages/barang" class="btn btn-cancel">Kembali</a>
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