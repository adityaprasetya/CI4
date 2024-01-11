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
                                        <h5 class="card-title"><?= $supplier->nm_spl ?></h5>
                                        <br>
                                        <p class="card-text">Nama Lengkap : <?= $supplier->nm_spl ?></p>
                                        <p class="card-text">Telepon : <?= $supplier->tl_spl ?></p>
                                        <p class="card-text">Alamat : <?= $supplier->al_spl ?></p>
                                        <a href="/pages/edit_sl/<?= $supplier->slug_spl ?>" class="btn btn-warning">Ubah</a>
                                        <form action="/pages/supplier/<?= $supplier->id_spl ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Ini ?')">Hapus</button>
                                        </form>
                                        <a href="/pages/supplier" class="btn btn-cancel mt-2">Kembali</a>
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