<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMVENT Politeknik TEDC Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}
body:before {
    content: '';
    position: fixed;
    width: 100vw;
    height: 100vh;
    background-image: url(assets/img/1.jpeg);
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    -webkit-background-size: cover;
    background-size: cover;
    -webkit-filter: blur(3px);
    -moz-filter: blur(3px);
    filter: blur(3px);
}
.contact-form {
    top: 85%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 530px;
    height: 820px;
    padding: 60px 40px;
    background: rgba(87, 143, 177 , 0.8);
}
.navbar {
    position: absolute;
    left: 0%;
    width: 100%;
}
.avatar {
    position: absolute;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    top: calc(-80px/2);
    left: 190px;
}
.contact-form h2 {
    margin: 0;
    padding: 0 0 5px;
    color: #fff;
    text-align: left;
    text-transform: uppercase;
    font-size: 18px;
    font-weight: bold;
}
.contact-form p {
    margin: 0;
    padding: 0;
    color: #fff;
}
.contact-form h5 {
    margin: 0;
    padding: 0;
    color: #E7ECF0;
    font-size: 16px;
}
.contoh1::-webkit-input-placeholder{
    color: whitesmoke;
}
 
/*support mozilla*/
.contoh1:-moz-input-placeholder{
    color: whitesmoke;
}
 
/*support internet explorer*/
.contoh1:-ms-input-placeholder{
    color: whitesmoke;
}
.contact-form input {
    width: 100%;
    margin-bottom: 20px;
}
.contact-form input[type=text], .contact-form input[type=password], .contact-form input[type=email] {
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}
.contact-form input[placeholder=Password] {
    color: #fff;
}
.contact-form input[type=submit] {
    height: 30px;
    color: #fff;
    font-size: 15px;
    background: red;
    cursor: pointer;
    border-radius: 25px;
    border: none;
    outline: none;
    margin-top: 15%;
}
.contact-form a {
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
}
input[type=checkbox] {
    width: 20%;
}

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-primary bg-transparant shadow-sm" >
            <div class="container">
                <img src="<?= base_url(); ?>assets/img/LOGO.png" width="40px">&nbsp;&nbsp;
                <a class="navbar-brand" href="register" style="font-size: 16px;">Sistem Informasi Inventaris <br>
                    <span>Politeknik TEDC Bandung</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                     
                            <li class="nav-item">
                                <a class="nav-link" href="login"Login><button type="submit" class="btn btn-primary">Login</button></a>
                            </li>
                
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
   
    <div class="contact-form">
        <h5 align="center">Create New Account</h5><br>
         <?= $this->session->flashdata('pesan'); ?>
         <?= form_open('', ['class' => 'user']); ?>
            <input autofocus="autofocus" autocomplete="off" value="<?= set_value('username'); ?>" type="text" name="username"class="contoh1" placeholder="Username">
            <?= form_error('username', '<small class="text-warning">', '</small>'); ?>
            <input class="contoh1" type="password" name="password" placeholder="Password">
            <?= form_error('password', '<small class="text-warning">', '</small>'); ?>
             <input type="password" name="password2" class="contoh1" placeholder="Konfirmasi Password">
            <?= form_error('password2', '<small class="text-warning">', '</small>'); ?>
             <input value="<?= set_value('no_induk'); ?>" type="text" name="no_induk" class="contoh1" placeholder="NIM">
            <?= form_error('nama', '<small class="text-warning">', '</small>'); ?>
            <input value="<?= set_value('nama'); ?>" type="text" name="nama" class="contoh1" placeholder="Nama Lengkap">
            <?= form_error('nama', '<small class="text-warning">', '</small>'); ?>
             <input value="<?= set_value('email'); ?>" type="email" name="email" class="contoh1" placeholder="Email">
            <?= form_error('email', '<small class="text-warning">', '</small>'); ?>
            <input value="<?= set_value('no_telp'); ?>" type="text" name="no_telp" class="contoh1" placeholder="Telepon">
            <?= form_error('no_telp', '<small class="text-warning">', '</small>'); ?>
            <button type="submit" class="btn btn-warning btn-user btn-block"><font color="blue">Sign Up</font></button>
             <div class=" small text-center mt-4"><a href="<?= base_url('auth') ?>" style="text-decoration:none;">Sign In!</a><br>
                                <a href="<?= base_url('auth/forgotpassword') ?>" style="text-decoration:none;">Forgot Password!</a>
                             </div>
           
         <?= form_close(); ?>
    </div>
</body>
</html>
