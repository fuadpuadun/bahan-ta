<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Products</h3>
    <hr>
    <!--Search bar-->
    <form method="GET" action="" class="form-group">
        <div class="input-group mb-4 border rounded-pill p-1">
            <input name="cari" type="text" placeholder="Mau cari apa..." class="form-control bg-none border-0 font-italic">
            <div class="input-group-append border-0">
                <button type="submit" class="btn btn-link text-success"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <!--Card-->
    <div class="row">
        <?php foreach($barang as $key => $data) {
            if($data['status_kursi'] == 0)
            {

             ?>
        <div class="col-6 col-sm-6 col-md-4 col-lg-4 d-flex">
            <div class="card mb-4">
                <img class="card-img" src="<?= base_url('barang/'.$data['fileGambar']) ?>">
                <div class="card-body">
                    <h4 class="card-title text-info"><?php echo $data['namabrg']; ?></h4>
                    <!--<h6 class="card-subtitle mb-2 text-muted">Stok tersedia: <?php echo $data['stok']; ?> pcs</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Berat: <?php echo $data['berat']*1000; ?> gram</h6>-->
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <div class="price text-success"><h5 class="mt-4">Rp. <?php echo format_rupiah($data['harga']); ?></h5></div>
                    <a href="<?php echo base_url('addtocart/'.$data['kodebrg']); ?>" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Pilih</a>
                </div>
            </div>
        </div>
        <?php } else {} }
        ?>
    </div>
    <?= $pager?>
</div>

<?= $this->endSection() ?>