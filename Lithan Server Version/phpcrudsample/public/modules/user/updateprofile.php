<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\business\Validation;
use classes\entity\User;

ob_start();
// include '/../../classes/business/UserManager.php';
// include '/../../classes/business/Validation.php';
include '../../includes/security.php';
include '../../includes/header.php';
include '../../includes/password.php';
?>

<?php

$formerror="";
$firstName="";
$lastName="";
$email="";
$password="";
$cpassword="";
$subs="";
$error_fname = "";
$error_lname = "";
$error_passwd = "";
$error_email = "";
$validate = new Validation();

if(!isset($_POST["submitted"])){
  $UM=new UserManager();
  $existuser=$UM->getUserByEmail($_SESSION["email"]);
  $firstName=$existuser->firstName;
  $lastName=$existuser->lastName;
  $email=$existuser->email;
  $password=$existuser->password;
  $cpassword=$password;
  $subState=$existuser->subscribe;
}else{
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"];
  $subState=$_POST["subCheckbox"];

  if($firstName!='' && $lastName!='' && $email!='' && $password!='' && $cpassword == $password){
      if ($validate->check_name($firstName, $error_fname) && $validate->check_name($lastName, $error_lname)) {
          if ($validate->check_email($email, $error_email)) {
              if ($validate->check_password($password, $error_passwd)) {
                  $update=true;
                  $UM=new UserManager();
                  if($email!=$_SESSION["email"]){
                      $existuser=$UM->getUserByEmail($email);
                      if(is_null($existuser)==false){
                          $formerror="User Email already in use, unable to update email";
                          $update=false;
                      }
                  }
                  if($update){
                      $existuser=$UM->getUserByEmail($_SESSION["email"]);
                      $existuser->firstName=$firstName;
                      $existuser->lastName=$lastName;
                      $existuser->email=$email;
                      $existuser->password=password_hash($password, PASSWORD_BCRYPT);
                      $existuser->id=$UM->getIdByEmail($_SESSION["email"]);
                      $existuser->subscribe=$subState;
                      $UM->updateUser($existuser);
                      $_SESSION["email"]=$email;
                      header("Location:../../home.php");
                  }
              }
          }
      }
  }else{
      $formerror="Please provide required values";
  }
}
?>
<head>
    <title>Update Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../bs/css/bootstrap.min.css">
    <script src="../../bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
</head>
<body style="min-height: 100vh; background-image: url(../../images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">
<br>
<div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.8); width: max-content;">

<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<h1>Update Profile</h1>
<div style="color: red;"><?=$formerror?></div>
<table width="800">
  <tr>
    <td>First Name</td>
    <td><input type="text" name="firstName" value="<?=$firstName?>" size="50"></td>
    <td style="color: red;"><?php echo $error_fname?></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input type="text" name="lastName" value="<?=$lastName?>" size="50"></td>
    <td style="color: red;"><?php echo $error_lname?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="email" value="<?=$email?>" size="50"></td>
    <td style="color: red;"><?php echo $error_email?></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" value="<?=$password?>" size="20"></td>
    <td style="color: red;"><?php echo $error_passwd?></td>
  </tr>
  <tr>
    <td>Confirm Password</td>
    <td><input type="password" name="cpassword" value="<?=$cpassword?>" size="20"></td>
    <td style="color: red;"><?php echo $error_passwd?></td>
  </tr>
  <tr>
    <td>Subscription</td>
    <td>
      <input type="hidden" name="subCheckbox" value="0">
      <input type="checkbox" name="subCheckbox" value="1" size="20" <?php echo ($subState==1 ? 'checked' : ''); ?>>
    </td>
  </tr>
  <tr>
	<td></td>
    <td><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    <input type="reset" name="reset" value="Reset" class="pure-button pure-button-primary"></td>
    </td>
  </tr>
</table>
</form>
</div>

<?php
include '../../includes/footer.php';
?>