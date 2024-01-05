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
                                        <h5 class="card-title"><?= $pelanggan->nm_plg ?></h5>
                                        <br>
                                        <p class="card-text">Nama Lengkap : <?= $pelanggan->nm_plg ?></p>
                                        <p class="card-text">Jenis Kelamin : <?= $pelanggan->jn_klm ?></p>
                                        <p class="card-text">Telepon : <?= $pelanggan->tlp ?></p>
                                        <a href="/pages/edit_pl/<?= $pelanggan->slug ?>" class="btn btn-warning">Ubah</a>
                                        <form action="/pages/<?= $pelanggan->id ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Ini ?')">Hapus</button>
                                        </form>
                                        <a href="/pages/pelanggan" class="btn btn-cancel mt-2">Kembali</a>
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