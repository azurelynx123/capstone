<?php
session_start();
include '../classes/business/UserManager.php';
include 'includes/security.php';
include 'includes/header.php';
?>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <script src="bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body style="min-height: 100vh; background-image: url(images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">

<br><br>
<h1 style="color:white">This is your Community Portal Home Page</h1>
<!-- !PAGE CONTENT! -->


<?php
include 'includes/footer.php';
?>
