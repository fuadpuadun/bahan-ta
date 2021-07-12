<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Form Konfirmasi Pesanan</h3>
    <hr>
    <!--Form INSERT-->
    <form action="<?php echo base_url('checkout/proses'); ?>" method="post">
        <div class="form-group">
            <label for="nama">Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama..." required autofocus>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat Email</label>
            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Email..." required autofocus>
        </div>
        <div class="form-group">
            <label for="hp">No HP</label>
            <input type="number" name="hp" class="form-control" id="hp" placeholder="+62..." required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Proses</button>
    </form>
</div>

<?= $this->endSection() ?>