<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <h3>Shopping Cart</h3>
    <hr>
    <table class="table table-responsive-sm">
        <thead class="bg-danger text-white">
            <tr>
                <th style="width:5%"></th>
                <th style="width:30%">Produk</th>
                <th style="width:25%">Nama</th>
                <th style="width:13%">Harga</th>
                <!--<th style="width:12%">Berat</th>-->
                <th style="width:14%">Jumlah</th>
                <th style="width:14%">Sub Harga</th>
                <!--<th style="width:12%">Sub Berat</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            $subHarga = 0;
            $subBerat = 0;
            $totalHarga = 0;
            $totalBerat = 0;
            if(isset($barang)){
            foreach($barang as $key => $data) {
                $subHarga =  $data['harga'] * $data['kuantitas'];
                $subBerat =  $data['berat'] * $data['kuantitas'];
                $totalHarga = $totalHarga + $subHarga;
                $totalBerat = $totalBerat + $subBerat;
                ?>
            <tr>
                <td><a href="<?php echo base_url('removeitemcart/'.$key); ?>" onclick="return confirm('Hapus barang?')" class="btn btn-danger btn-lg my-5"><i class="fa fa-trash"></i></a></td>
                <td><img src="<?= base_url('barang/'.$data['fileGambar']) ?>"class="img-fluid"></td>
                <td><h5 class="text-info"><?php echo $data['namabrg']; ?></h5></td>
                <td><h6 class="text-secondary">Rp<?php echo format_rupiah($data['harga']); ?></h6></td>
                <!--<td>--<h6 class="text-secondary"><?php echo $data['berat']*1000; ?> gram</h6></td>-->
                <td>
                    <form method="post" action="<?php echo base_url('updatecart/'.$key); ?>" class="form-group">
                        <div class="input-group">
                            <input type="number" class="form-control" min="1" max="" value="<?php echo $data['kuantitas']; ?>" name="kuantitas">
                            <button class="btn btn-link" type="submit" name="update"><i class="fa fa-sync-alt"></i></button>
                        </div>
                    </form>
                </td>  
                <td> <h6 class="text-secondary">Rp<?php echo format_rupiah($subHarga); ?></h6></td>
                <!--<td><h6 class="text-secondary"><?php echo $subBerat*1000; ?> gram</h6></td>-->
            </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><a  class="text-decoration-none" href="<?php echo base_url('clearcart'); ?>" onclick="return confirm('Hapus semua barang dalam keranjang?')" >BERSIHKAN KERANJANG</a></td>
                <td colspan="2" class="text-right font-weight-bold">Total</td>
                <td class="font-weight-bold">Rp<?php echo format_rupiah($totalHarga); ?></td>
                <!--<td class="font-weight-bold"><?php echo $totalBerat*1000; ?> gram</td>-->
            </tr>
        </tfoot>
    </table>
    <!-- Fitur -->
    <div class="d-flex justify-content-sm-between">
        <a href="<?php echo base_url('beranda'); ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Tambah produk</a>
        <a href="<?php echo base_url('checkout'); ?>" class="btn btn-success">Checkout <i class="fa fa-angle-right"></i></a>
    </div>
</div>

<?= $this->endSection() ?>