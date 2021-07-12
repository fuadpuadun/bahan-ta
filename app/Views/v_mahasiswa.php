<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        window.onload = function () {

        //Better to construct options first and then pass it as a parameter
        var options = {
            title: {
                text: "Grafik Tinggi Mahasiswa"              
            },
            data: [              
            {
                // Change type to "doughnut", "line", "splineArea", etc.
                type: "column",
                dataPoints: [
                    <?php
                    if(isset($mahasiswa)){
                    foreach($mahasiswa as $idx => $row) { 
                        // lewati baris ke 0 pada file excel
                        // dalam kasus ini, array ke 0 adalahpara title
                        if($idx == 0) {
                            continue;
                        }
                        ?>
                        { label: "<?php echo $row[1]; ?>",  y: <?php echo $row[3]; ?>  },
                    <?php }} ?>
                ]
            }
            ]
        };

        $("#chartContainer").CanvasJSChart(options);
        }
    </script>

</head>
<body>
    <div class="container">
        <h3 class="mt-5">Data Mahasiswa</h3>
        
        <?php echo form_open_multipart(base_url('mahasiswa')); ?>
 
        <div class="form-group">
            <input type="file" name="file_upload" id=""> 
        </div>
 
        <div class="form-group">
            <button type="submit" class="btn btn-success">Import</button>
        </div>
 
        <?= form_close() ?>

        <!--Display-->
        <div class="table-responsive">
            <table class="table  table-hover">
                <thead class="bg-primary text-white">
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>UMUR</th>
                    <th>TINGGI</th>
                </thead>
                <tbody>
                    <?php
                    if(isset($mahasiswa)){
                    foreach($mahasiswa as $idx => $row) { 
                        // lewati baris ke 0 pada file excel
                        // dalam kasus ini, array ke 0 adalahpara title
                        if($idx == 0) {
                            continue;
                        }
                        ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <?php
        if(isset($mahasiswa)){ ?>
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        <?php } ?>
    </div>
</body>
</html>