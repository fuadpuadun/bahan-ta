<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <div class="card">
        <div class="card-header">
            Form Validation Codeigniter 4
        </div>
        <form method="post" action="<?php echo base_url('/mahasiswa/validasi') ?>">
        <div class="card-body">
            <!-- cek validasi -->
            <?php
                $inputs = session()->getFlashdata('inputs');
                $errors = session()->getFlashdata('errors');
                $success = session()->getFlashdata('success');
                if(!empty($errors)){ ?>
                <div class="alert alert-danger" role="alert">
                    Whoops! Ada kesalahan saat input data:
                    <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
                <?php
                }
                if(!empty($success)){ ?>
                <div class="alert alert-success" role="alert">
                    Sukses! Berhasil melakukan registrasi.
                </div>
            <?php } 
            ?>
            <?php $validation = \Config\Services::validation(); ?>
            <div class="form-group">
                <label for="">NIM</label>
                <input type="text" name="nim" value="" placeholder="contoh : 181511048" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="" placeholder="contoh : Irfan" class="form-control"required>
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <br>
                    <input type="radio" id="male" name="gender" value="Laki-laki" required>
                    <label for="male">Laki-laki</label><br>
                    <input type="radio" id="female" name="gender" value="Perempuan">
                    <label for="female">Perempuan</label><br>
            </div>
            <div class="form-group">
                <label for="pendidikan">Pendidikan</label>
                <select class="form-control" id="pendidikan" name="pendidikan">
                    <option>D2 Teknik Informatika</option>
                    <option>D3 Teknik Informatika</option>
                    <option>D4 Teknik Informatika</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" value="" placeholder="youremail@domain.com" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Hobi</label>
                <br>
                    <input type="checkbox" id="hobi1" name="hobi[]" value="Bernyanyi">
                    <label for="hobi1"> Bernyanyi</label><br>
                    <input type="checkbox" id="hobi2" name="hobi[]" value="Berenang">
                    <label for="hobi2"> Berenang</label><br>
                    <input type="checkbox" id="hobi3" name="hobi[]" value="Berlari">
                    <label for="hobi3"> Berlari</label><br>
                    <input type="checkbox" id="hobi4" name="hobi[]" value="Bermain">
                    <label for="hobi4"> Bermain</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
    </div>
</body>
</html>