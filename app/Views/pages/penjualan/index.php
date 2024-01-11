<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Data Penjualan</h5>
                    <a href="/pages/create_pj" class="btn btn-primary mb-4">Tambah</a>
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
                                    <th scope="col">Nomor Penjualan</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga(Rp)</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Total(Rp)</th>
                                    <th scope="col">Tanggal Penjualan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_pjl = 0; ?>
                                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                                <?php foreach ($penjualan as $j) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $j->nm_pjl ?></td>
                                        <td><?= $j->nm_plg ?></td>
                                        <td><?= $j->nm_brg ?></td>
                                        <td><?= number_format($j->hrg, 0, ',', '.') ?></td>
                                        <td><?= $j->qty ?></td>
                                        <td><?= $j->sat ?></td>
                                        <td><?= number_format($j->ttl = ($j->hrg * $j->qty), 0, ',', '.') ?></td>
                                        <td><?= $j->tgl ?></td>
                                        <td><?= $j->sts ?></td>
                                        <td><?= $j->ktr ?></td>
                                        <td>
                                            <a href="/pages/detail_pj/<?= $j->slug_pjl ?>" class="btn btn-primary">Detail</a>
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
                                    <?= $pager->links('penjualan', 'pagination'); ?>
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