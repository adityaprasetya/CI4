<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Pelanggan</h5>
                    <a href="/pages/create_pl" class="btn btn-primary mb-4">Tambah</a>
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
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                                <?php foreach ($pelanggan as $p) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $p->nm_plg ?></td>
                                        <td><?= $p->jn_klm ?></td>
                                        <td><?= $p->tlp ?></td>
                                        <td><?= $p->almt ?></td>
                                        <td>
                                            <a href="/pages/detail_pl/<?= $p->slug ?>" class="btn btn-primary">Detail</a>
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
                                    <?= $pager->links('pelanggan', 'pelanggan_page'); ?>
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