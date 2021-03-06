<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Sales Detail</h3>
    <hr>
    <!-- Barang -->
    <table class="table table-responsive-sm table-hover">
        <thead class="bg-danger text-white">
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subHarga = 0;
            $subBerat = 0;
            $totalHarga = 0;
            $totalBerat = 0;
            if(isset($jual)){
            foreach($jual as $key => $data) {
                $subHarga =  $data['harga'] * $data['jumlah'];
                $subBerat =  $data['berat'] * $data['jumlah'];
                $totalHarga = $totalHarga + $subHarga;
                $totalBerat = $totalBerat + $subBerat;
                ?>
            <tr>
                <td><?php echo $data['namabrg']; ?></td>
                <td>Rp<?php echo format_rupiah($data['harga']); ?></td>
                <td><?php echo $data['jumlah']; ?> pcs</td>
                <td>Rp<?php echo format_rupiah($subHarga); ?></td> 
            </tr>
            <?php }} ?>
        </tbody>
        <tfoot class="font-weight-bold">
            <tr>
                <td colspan="3" class="text-right">Total Harga Barang</td>
                <td>Rp<?php echo format_rupiah($totalHarga); ?></td>
                <!--<td><?php echo $totalBerat; ?> kg</td>-->
            </tr>
        </tfoot>
    </table>
    <!-- Pembeli -->
    <div class="card my-5 border-0 shadow-lg bg-white rounded">
        <div class="card-body">
            <div class="text-right">Tanggal transaksi : <?php echo $penjualan['tglTransaksi'];?></div>
            <hr>
            <form>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NAMA</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['nama']?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">HP</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['hp']?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['alamat']?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">STATUS PESANAN</label>
                    <div class="col-sm-9">
                        :&emsp;<?php if($penjualan['status_pemesanan'] == 1)
                    {
                        echo 'Sudah Bayar';
                    }
                    else{echo 'Belum Bayar';}
                    ?>
                    </div>
                </div>
                <!--<div class="form-group row">
                    <label class="col-sm-3 col-form-label">KECAMATAN TUJUAN</label>
                    <div class="col-sm-9">
                        :&emsp;<?php echo $penjualan['kecamatanTujuan']?>
                    </div>
                </div>-->
            </form>
        </div>
        <div class="card-footer text-right">
            <form>
                <div class="form-group row">
                    <label class="col-sm-10 col-form-label"><h4>TOTAL YANG HARUS DIBAYAR :</h4></label>
                    <div class="col-sm-2">
                        <h4>Rp<?php echo format_rupiah($totalHarga+$penjualan['ongkir']);?></h4>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="<?php echo base_url('invoice'); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Konfirmasi Pembayaran</a>
    </div>
    <br>
    <div class="d-flex justify-content-sm-between">
        <a href="<?php echo base_url('invoice'); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>