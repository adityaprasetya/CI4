<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<!--  Main wrapper -->
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Tambah Penjualan</h5>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="/pages/save_pj" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nomor Penjualan</label>
                                    <input type="text" class="form-control <?= ($validation->hasError('nm_pjl')) ? 'is-invalid' : '' ?>" id="nm_pjl" name="nm_pjl" readonly>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nm_pjl') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nm_plg" class="form-label">Nama Pelanggan</label>
                                    <select name="id_plg" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($pelanggan as $p) :  ?>
                                            <option value="<?= $p->id_plg ?>"><?= $p->nm_plg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="nm_brg" class="form-label">Nama Barang</label>
                                    <select name="id_brg" class="form-select select2" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <?php foreach ($barang as $b) :  ?>
                                            <option value="<?= $b->id_brg ?>" hrg="<?= $b->hrg ?>"><?= $b->nm_brg ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hrg" class="form-label">Harga (Rp)</label>
                                    <input oninput="findTotal()" type="number" class="form-control" id="hrg" name="hrg" value="" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">QTY</label>
                                    <input oninput="findTotal()" type="number" class="form-control" id="qty" name="qty" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ttl" class="form-label">Total (Rp)</label>
                                    <input type="number" class="form-control" id="ttl" name="ttl" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl" class="form-label">Tanggal</label>
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
                                <button type="submit" class="btn btn-primary mt-2">Tambah</button>
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