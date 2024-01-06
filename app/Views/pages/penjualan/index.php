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
                                    <th scope="col">Total(Rp)</th>
                                    <th scope="col">Tanggal Penjualan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                                <?php foreach ($penjualan as $j) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $j['nm_pjl'] ?></td>
                                        <td><?= $j['nm_plg'] ?></td>
                                        <td><?= $j['nm_brg'] ?></td>
                                        <td><?= $j['hrg'] ?></td>
                                        <td><?= $j['qty'] ?></td>
                                        <td><?= $j['ttl'] ?></td>
                                        <td><?= $j['tgl'] ?></td>
                                        <td><?= $j['sts'] ?></td>
                                        <td><?= $j['ktr'] ?></td>
                                        <td>
                                            <!-- <a href="/pages/edit_pj/<?= $j['slug'] ?>" class="btn btn-primary">Ubah</a> -->
                                            <form action="/pages/penjualan/<?= $j['id_pjl'] ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Ini ?')">Hapus</button>
                                            </form>
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