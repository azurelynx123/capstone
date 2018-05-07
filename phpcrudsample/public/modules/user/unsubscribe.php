<?php 
use classes\business\UserManager;

require_once '../../includes/autoload.php';
include '../../includes/header.php';

$valhas = "";

$unsubId = $_GET['id'];
$valhas = $_GET['valhas'];

$UM=new UserManager();
?>

<h1>Unsubscribe</h1>

<?php
if($valhas != md5($unsubId)){
    echo "Validation Failed";
} else {
    // echo $unsubId;echo "<br>";echo $valhas;
    $user = $UM->getUserById($unsubId);
    $fullname = $user->firstName." ".$user->lastName;
    $UM->unsubscribe($unsubId);
    ?>
    <b><?=$fullname.", "?></b><br>
    <p>You have unsubscribe to our newsletter mailing. 
    If you wish to continue to receive news and updates, go to your Profile page and check the box under subscription.<p>
    <?php 
}

include '../../includes/footer.php';
?>