<?php
require_once '../../includes/autoload.php';
// include '/../../classes/business/UserManager.php';
// include '/../../classes/business/Validation.php';
include '../../includes/header.php';
include '../../includes/password.php';

use classes\util\DBUtil;
use classes\business\UserManager;
use classes\business\Validation;
use classes\entity\User;

$formerror = "";

$firstName = "";
$lastName = "";
$email = "";
$password = "";
$cpassword = "";
$error_fname = "";
$error_lname = "";
$error_passwd = "";
$error_email = "";
$validate = new Validation();

if (isset($_REQUEST["submitted"])) {
    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $cpassword = $_REQUEST["cpassword"];
    
    if ($firstName != '' && $lastName != '' && $email != '' && $password != '' && $cpassword == $password) {
        if ($validate->check_name($firstName, $error_fname) && $validate->check_name($lastName, $error_lname)) {
            if ($validate->check_email($email, $error_email)) {
                if ($validate->check_password($password, $error_passwd)) {
                    $UM = new UserManager();
                    $user = new User();
                    $user->firstName = $firstName;
                    $user->lastName = $lastName;
                    $user->email = $email;
                    $user->password = password_hash($password, PASSWORD_BCRYPT);
					$user->role = "user";
					$user->subscribe = 1;
                    $existuser = $UM->getUserByEmail($email);
                    
                    if (! isset($existuser)) {
                        // Save the Data to Database
                        $UM->saveUser($user);
                        echo '<meta http-equiv="Refresh" content="1; url=./registerthankyou.php">';
                    } else {
                        $formerror = "User Already Exist";
                    }
                }
            }
        }
        
    } else if ($cpassword != $password) {
        $formerror = "Passwords don't match each other.";
    } else {
        $formerror = "Please fill in the fields";
    }
}
?>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<form name="myForm" method="post" class="pure-form pure-form-stacked">
	<h1>Registration Form</h1>
	<div style="color: red; text-transform: uppercase"><?=$formerror?></div>
	<table width="900">
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
			<br>
			<td><input type="submit" name="submitted" value="Submit"> 
			<input type="reset" name="reset" value="Reset"></td>
		</tr>
	</table>
</form>

<?php
include '../../includes/footer.php';
?>