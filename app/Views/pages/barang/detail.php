<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <?= csrf_field(); ?>
                                        <h5 class="card-title"><?= $barang->nm_brg ?></h5>
                                        <br>
                                        <p class="card-text">Supplier :</p>
                                        <select name="id_spl" class="form-select" aria-label="Default select example" disabled>
                                            <?php foreach ($supplier as $s) :  ?>
                                                <option value="<?= $s->id_spl ?>" <?= $barang->id_spl == $s->id_spl ? 'selected' : null ?>><?= $s->nm_spl ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="card-text">Harga : Rp. <?= $barang->hrg ?></p>
                                        <p class="card-text">Stok : <?= $barang->stk ?></p>
                                        <p class="card-text">Satuan : <?= $barang->sat ?></p>
                                        <a href="/pages/edit/<?= $barang->slug_brg ?>" class="btn btn-warning">Ubah</a>
                                        <form action="/pages/<?= $barang->id_brg ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Ini ?')">Hapus</button>
                                        </form>
                                        <a href="/pages/barang" class="btn btn-cancel mt-2">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endsection(); ?>