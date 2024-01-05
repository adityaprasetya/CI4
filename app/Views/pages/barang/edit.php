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
                            <form action="/pages/update/<?= $barang->id ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?= $barang->id ?>">
                                <input type="hidden" name="slug" value="<?= $barang->slug ?>">
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nm_brg')) ? 'is-invalid' : '' ?>" id="nm_brg" value="<?= $barang->nm_brg ?>" name="nm_brg">
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="hrg" value="<?= $barang->hrg ?>" name="hrg">
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="stk" value="<?= $barang->stk ?>" name="stk">
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="sat" value="<?= $barang->sat ?>" name="sat">
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