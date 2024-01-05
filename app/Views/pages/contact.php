<?= $this->extend('layout/template'); ?>

<?= $this->section('page'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Contact</h1>

            <ul>
                <li><?= $nama_toko; ?></li>
                <li><?= $alamat_toko; ?></li>
                <li><?= $ponsel; ?></li>
            </ul>

        </div>
    </div>
</div>

<?= $this->endsection(); ?>