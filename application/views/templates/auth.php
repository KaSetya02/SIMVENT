<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
    <link rel="icon" type="image/png" href="images/logo.png"/>
    <title><?= $title; ?> SIMVENT Politeknik TEDC Bandung</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 435px;
    height: 550px;
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


<body >

    <div class="container">

        <?= $contents; ?>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>