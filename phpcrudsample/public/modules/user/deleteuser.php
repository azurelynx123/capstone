<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
// include '../../classes/business/UserManager.php';
include '../../includes/security.php';
include '../../includes/header.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$deleteflag=false;

if(isset($_POST["submitted"])){
  if(isset($_GET["id"])){
       $UM=new UserManager();
       $existuser=$UM->deleteAccount($_GET["id"]);
        $formerror="User deleted successfully.";
		$deleteflag=true;
	}
}else if(isset($_POST["cancelled"])){
	header("Location:../../home.php");
}else{
	if(isset($_GET["id"]))
	{
	  $UM=new UserManager();
	  $existuser=$UM->getUserById($_GET["id"]);
	  $firstName=$existuser->firstName;
	  $lastName=$existuser->lastName;
	  $email=$existuser->email;
	  $password=$existuser->password;
	}
}
?>
<head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../bs/css/bootstrap.min.css">
        <script src="../bs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
    </head>
	
    <body style="min-height: 100vh; background-image: url(images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">

<!-- <link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css"> -->
<form name="deleteUser" method="post" class="pure-form pure-form-stacked">
<h1>Delete User</h1>
<div><?=$formerror?></div>
<?php
if (!$deleteflag)
{
?>
<table width="800">
  <tr>
    <td>Are you sure that you want to delete the following record?</td>
  </tr>
   <tr>
    <td><?=$email?></td>
  </tr>
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Delete" class="pure-button pure-button-primary">
    <input type="submit" name="cancelled" value="Cancel" class="pure-button pure-button-primary"></td>
    </td>
  </tr>
</table>
<?php
}
?>
</form>


<?php
include '../../includes/footer.php';
?>