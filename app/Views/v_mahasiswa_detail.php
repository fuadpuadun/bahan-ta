<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<!-- Detail -->
<?php 
    foreach($mahasiswa as $key => $data) { ?>
        <p>NIM  : <?php echo $data->NIM; ?></p>
        <p>NAMA : <?php echo $data->NAMA; ?></p>
        <p>UMUR : <?php echo $data->UMUR; ?></p>
<?php } ?>

<?= $this->endSection() ?>