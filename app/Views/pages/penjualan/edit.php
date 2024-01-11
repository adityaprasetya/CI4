<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Ubah Penjualan</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/update_pj/<?= $penjualan->id_pjl ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_pjl" value="<?= $penjualan->id_pjl ?>">
                                <input type="hidden" name="slug_pjl" value="<?= $penjualan->slug_pjl ?>">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nomor Penjualan</label>
                                    <input type="text" class="form-control" id="nm_pjl" name="nm_pjl" value="<?= $penjualan->nm_pjl ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nama Pelanggan</label>
                                    <select name="id_plg" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($pelanggan as $p) :  ?>
                                            <option value="<?= $p->id_plg ?>" <?= $penjualan->id_plg == $p->id_plg ? 'selected' : null ?>><?= $p->nm_plg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <select name="id_brg" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($barang as $b) :  ?>
                                            <option value="<?= $b->id_brg ?>" <?= $penjualan->id_brg == $b->id_brg ? 'selected' : null ?>><?= $b->nm_brg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga (Rp)</label>
                                    <select oninput="findTotal2()" id="hrg" name="hrg" class="form-select" aria-label="Default select example" disabled>
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($barang as $b) :  ?>
                                            <option value="<?= $b->hrg ?>" <?= $penjualan->id_brg == $b->id_brg ? 'selected' : null ?>><?= $b->hrg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">QTY</label>
                                    <input oninput="findTotal2()" type="number" class="form-control" id="qty" name="qty" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ttl" class="form-label">Total (Rp)</label>
                                    <input type="number" class="form-control" id="ttl" name="ttl" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal Penjualan</label>
                                    <input class="form-control" type="date" id="tgl" name="tgl" value="2024-05-01" min="2024-05-01" max="2025-06-14" />
                                </div>
                                <div class="mb-3">
                                    <label for="sts" class="form-label">Status</label>
                                    <select name="sts" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum">Belum</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="ktr" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="ktr" name="ktr">
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Ubah</button>
                                <a href="/pages/penjualan" class="btn btn-cancel mt-2">Kembali</a>
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