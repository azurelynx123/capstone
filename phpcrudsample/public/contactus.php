<?php
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
?>
<head>
    <title>Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <script src="bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body style="min-height: 100vh; background-image: url(images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">

<br>
<div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.8); width: max-content;">
<h3>CONTACT INFORMATION</h3>
<p>
Customer Online Care<br>
Call us at +65 1800 222 6868 for any assistance required.<br>
   Operating hour is from Monday to Saturday, 10am to 7pm;<br>
   Sunday & Public Holiday, 10am to 2pm.<br><br> 
</p>
</div>
<br>
<center>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7600334737967!2d103.88985331447665!3d1.3196913620398996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da19149fe4a925%3A0x82606eb494fd093c!2sLithan+Academy!5e0!3m2!1sen!2ssg!4v1514739525393" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</center>
<br>
<div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.8); width: max-content;">
<?php
include './feedback.php';
?>
</div>
<?php
include 'includes/footer.php';
?>