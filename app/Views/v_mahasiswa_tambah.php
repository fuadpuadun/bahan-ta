<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>
<div class="container">
        <h3>Tambah Data Mahasiswa</h3>
        <!--Form INSERT-->
        <form action="<?php echo base_url('mahasiswa/simpan'); ?>" method="post">
                <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" name="NIM" class="form-control" placeholder="Nomor induk mahasiswa" required autofocus>
                </div>
                <div class="form-group">
                        <label for="">NAMA</label>
                        <input type="text" name="NAMA" class="form-control" placeholder="Nama lengkap" required autofocus>
                </div>
                <div class="form-group">
                        <label for="">UMUR</label>
                        <input type="text" name="UMUR" class="form-control" placeholder="Umur sekarang" required autofocus>
                </div>
                <button type="submit" class="btn btn-success">TAMBAHKAN</button>
        </form>
</div>
<?= $this->endSection() ?>