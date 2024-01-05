<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Ubah Pelanggan</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/update_pl/<?= $pelanggan->id ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="id" value="<?= $pelanggan->id ?>">
                                <input type="hidden" name="slug" value="<?= $pelanggan->slug ?>">
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nm_brg')) ? 'is-invalid' : '' ?>" id="nm_brg" value="<?= $pelanggan->nm_plg ?>" name="nm_plg">
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="hrg" value="<?= $pelanggan->jn_klm ?>" name="jn_klm">
                                </div>
                                <div class="mb-3">
                                    <label for="stk" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="stk" value="<?= $pelanggan->tlp ?>" name="tlp">
                                </div>
                                <div class="mb-3">
                                    <label for="sat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="sat" value="<?= $pelanggan->almt ?>" name="almt">
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