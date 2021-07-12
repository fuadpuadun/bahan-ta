<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Selamat Datang!</title>
</head>
<body>
    <h3>Login</h3>
    <!--Form INSERT-->
    <form action="<?php echo base_url('/masuk/auth'); ?>" method="post">

            <label for="">Username</label>
            <input type="text" name="username" class="form-control" placeholder="username..." required autofocus>

            <label for="">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password..." required autofocus>

            <button type="submit">Masuk <i class="fas fa-plus"></i></button>
    </form>
    <?php if(session()->getFlashdata('message')):?>
        <?= session()->getFlashdata('message') ?>
    <?php endif;?>
</body>
</html>