
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMVENT Politeknik TEDC Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="contact-form">
        <table>
        <th ><img src="<?= base_url(); ?>assets/img/LOGO.png" width="55px"></th>
        <th><h2>Sistem Informasi Inventaris</h2><p>Politeknik TEDC Bandung</p></th>
        </table><br>
        <h5>Log in To Your Account</h5><br>
         <?= $this->session->flashdata('pesan'); ?>
         <?= form_open('', ['class' => 'user']); ?>
            <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username" class="contoh1" placeholder="Username">
            <?= form_error('username', '<small class="text-warning">', '</small>'); ?>
            <input class="contoh1" type="password" name="password" placeholder="Password">
            <?= form_error('password', '<small class="text-warning">', '</small>'); ?>
             <p style="margin-right: 205px;"><input type="checkbox">Remember Me</p>
            <button type="submit" class="btn btn-primary btn-user btn-block">Sign In</button>
             <div class=" small text-center mt-4"><a href="<?= base_url('register') ?>" style="text-decoration:none;">Create an Account!</a><br>
                                <a href="<?= base_url('auth/forgotpassword') ?>" style="text-decoration:none;">Forgot Password!</a>
                             </div>
           
         <?= form_close(); ?>
    </div>
</body>
</html>
