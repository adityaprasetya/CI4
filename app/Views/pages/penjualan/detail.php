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
                                        <h5 class="card-title"><?= $penjualan->nm_pjl ?></h5>
                                        <br>

                                        <p class="card-text">Nama Pelanggan : </p>
                                        <select name="id_plg" class="form-select" aria-label="Default select example" disabled>
                                            <?php foreach ($pelanggan as $p) :  ?>
                                                <option value="<?= $p->id_plg ?>" <?= $penjualan->id_plg == $p->id_plg ? 'selected' : null ?>><?= $p->nm_plg ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="card-text">Nama Barang : </p>
                                        <select name="id_brg" class="form-select" aria-label="Default select example" disabled>
                                            <?php foreach ($barang as $b) :  ?>
                                                <option value="<?= $b->id_brg ?>" <?= $penjualan->id_brg == $b->id_brg ? 'selected' : null ?>><?= $b->nm_brg ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="card-text">Harga (Rp) : </p>
                                        <select name="id_brg" class="form-select" aria-label="Default select example" disabled>
                                            <?php foreach ($barang as $b) :  ?>
                                                <option value="<?= $b->id_brg ?>" <?= $penjualan->id_brg == $b->id_brg ? 'selected' : null ?>><?= $b->hrg ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="card-text" name="qty">QTY : </p>
                                        <input type="number" class="form-control" id="ttl" name="ttl" value="<?= $penjualan->qty ?>" readonly>
                                        <p class="card-text">Total : </p>
                                        <select name="id_brg" class="form-select" aria-label="Default select example" disabled>
                                            <?php foreach ($barang as $b) :  ?>
                                                <option value="<?= $b->id_brg ?>" <?= $penjualan->id_brg == $b->id_brg ? 'selected' : null ?>><?= number_format($ttl = ($b->hrg * $penjualan->qty), 0, ',', '.') ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p class="card-text">Tangga Penjualan : </p>
                                        <input class="form-control" type="date" id="tgl" name="tgl" value="<?= $penjualan->tgl ?>" min="2024-05-01" max="2025-06-14" readonly />
                                        <p class="card-text">Status : </p>
                                        <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $penjualan->sts ?>" readonly>
                                        <p class="card-text">Keterangan : </p>
                                        <input type="text" class="form-control" id="ttl" name="ttl" value="<?= $penjualan->ktr ?>" readonly>
                                        <a href="/pages/edit_pj/<?= $penjualan->slug_pjl ?>" class="btn btn-warning">Ubah</a>
                                        <form action="/pages/penjualan/<?= $penjualan->id_pjl ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data Ini ?')">Hapus</button>
                                        </form>
                                        <a href="/pages/penjualan" class="btn btn-cancel mt-2">Kembali</a>
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