<?php 
use classes\business\UserManager;

require_once '../../includes/autoload.php';
include '../../includes/header.php';

$valhas = "";

$unsubId = $_GET['id'];
$valhas = $_GET['valhas'];

$UM=new UserManager();
?>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
    <link rel="stylesheet" href="../../bs/css/bootstrap.min.css">
    <script src="../../bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
</head>
<body style="min-height: 100vh; background-image: url(../../images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">
<br>



<?php
if($valhas != md5($unsubId)){
    echo "Validation Failed";
} else {
    $user = $UM->getUserById($unsubId);
    $fullname = $user->firstName." ".$user->lastName;
    $UM->unsubscribe($unsubId);
    ?>
    <div class="col-lg-4 col-lg-offset-4" style="background-color: rgba(255, 255, 255, 0.8); width:max-content">

        <h1>Unsubscribe</h1>
        <b><?=$fullname.", "?></b><br>
        <p>
        You have unsubscribe to our newsletter mailing.<br>
        If you wish to continue to receive news and updates, go to your Profile page and check the box under subscription.
        <p>
        
    </div>
    <?php 
}

include '../../includes/footer.php';
?>