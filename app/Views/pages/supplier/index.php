<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Supplier</h5>
                    <a href="/pages/create_sl" class="btn btn-primary mb-4">Tambah</a>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <form class="row" method="post">
                        <div class="col-4 mb-3">
                            <input type="text" class="form-control" id="cari" name="cari">
                        </div>
                        <div class="col-auto mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Cari</button>
                        </div>
                    </form>
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                                <?php foreach ($supplier as $s) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $s->nm_spl ?></td>
                                        <td><?= $s->tl_spl ?></td>
                                        <td><?= $s->al_spl ?></td>
                                        <td>
                                            <a href="/pages/detail_sl/<?= $s->slug ?>" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="container d-flex">
                            <div class="row">
                                <div class="col">
                                    <a href="">Halaman </a>
                                </div>
                                <div class="col">
                                    <?= $pager->links('supplier', 'pagination'); ?>
                                </div>
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