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
    background-image: url(../assets/img/1.jpeg);
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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 430px;
    height: 450px;
    padding: 80px 40px;
    background: rgba(87, 143, 177 , 0.8);
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
    <div class="contact-form">
         <p align="center" style="margin-top: 10px">Forgot Your Password</p>
         <p style="color: yellow;margin-top: 10px;font-size: 12px;text-align:center;">Change Your Password for  <?= $this->session->userdata('reset_email'); ?></p><br>
          <?= $this->session->flashdata('pesan'); ?>
                            <?= form_open('auth/changepassword', ['class' => 'user']); ?>
                            <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off"  id="password1" type="password" name="password1" class="contoh1" placeholder="Enter New Password">
                                <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                            </div>
                             <div class="form-group">
                                <input autofocus="autofocus" autocomplete="off" id="password2" type="password" name="password2" class="contoh1" placeholder="Repeat Password">
                                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            
                            <button type="submit" class="btn btn-warning btn-user btn-block"><font color="blue">
                                Ganti Password</font>
                            </button>
                             <br>
        <?= form_close(); ?>
    </div>
</body>
</html>
