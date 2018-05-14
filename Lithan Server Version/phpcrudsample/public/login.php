<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;

require_once 'includes/autoload.php';
include 'includes/header.php';
include 'includes/password.php';
$formerror = "";

$email = "";
$password = "";
$error_auth = "";
$error_name = "";
$error_passwd = "";
$error_email = "";
$validate = new Validation();

if (isset($_POST["submitted"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($validate->check_email($email, $error_email)) {
        if ($validate->check_password($password, $error_passwd)) {
            $UM = new UserManager();
            if ($UM->loginPasswordCheck($email, $password)) {
                $existuser = $UM->getUserIdRoleByEmail($email);
                if (isset($existuser)) {
                    echo "Login Success<br/>";
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $existuser->id;
                    $_SESSION['role'] = $existuser->role;
                    echo '<meta http-equiv="Refresh" content="1; url=home.php">';
                } else {
                    $formerror = "Invalid User Name or Password";
                }
            } else {
                $formerror = "Invalid Password";
            }
        }
    }
}

?>

<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
        <link rel="stylesheet" href="bs/css/bootstrap.min.css">
        <script src="bs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    </head>
	
    <body style="min-height: 100vh; background-image: url(images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">
    <br>
        <div class="col-lg-4 col-lg-offset-4" style="background-color: rgba(255, 255, 255, 0.8)">
            <div class="container-fluid" style="min-height: 300px; width:max-content">
                <h1 style="text-align: center">Login</h1>
                    <center>
                    <form name="myForm" method="post" class="pure-form pure-form-stacked">
                        <table border='0' width="100%">
                        	<tr><td>Email: <input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30"></td></tr>
                        	<tr><td><?php echo $error_name?></td></tr>
                        	<tr><td><br></td><tr>
							<tr><td>Password: <input type="password" name="password" value="<?=$password?>" required title="Cannot be empty field" size="30"></td></tr>
                        	<tr><td><?php echo $error_passwd?></td></tr>
                        	<tr><td><br></td><tr>
                        <tr>
                            <td><center>
								<input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
                                <span>  </span>
                                <input type="reset" value="Cancel" class="pure-button pure-button-primary">
                            </center></td>
                        </tr>
                        <tr><p style="color:red;"><?php echo $formerror?></p></tr>
                        <tr>
			            
			            <td><br> 
			                <a class="pure-button" href="modules/user/register.php">Register Now</a>
			                <a class="pure-button" href="./forgetpassword.php">Forget Password</a>
			            </td>
		                </tr>
                        </table>
                    </center>
                    </form><br>
            </div>
        </div>
    </body>
</html>


<?php
include 'includes/footer.php';
?>