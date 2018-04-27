<?php
use classes\business\UserManager;
use classes\business\Validation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'includes/autoload.php';
// include '/../classes/business/UserManager.php';
// include '/../classes/business/Validation.php';
include 'includes/header.php';
require '/includes/PHPMailer/src/Exception.php';
require '/includes/PHPMailer/src/PHPMailer.php';
require '/includes/PHPMailer/src/SMTP.php';

$formerror="";

$email="";
$password="";
$error_auth="";
$error_name="";
$error_passwd="";
$error_email="";
$validate=new Validation();

if(isset($_POST["submitted"])){
    $email=$_POST["email"];
    if($validate->check_email($email, $error_email)){
        $UM=new UserManager();
        $existuser=$UM->getUserByEmail($email);
        if(isset($existuser)){
            //generate new password
            $newpassword=$UM->randomPassword(15,1,"lower_case,upper_case,numbers");
            //update database with new password
            $UM->updatePassword($email,$newpassword[0]);
            //$formerror="Valid email user. password: ".$newpassword[0];
            
            //get User's full name
            $name = $UM->getNameByEmail($email);
            
            //coding for sending email
            $to = $email;
            $toName = $name;
            $subject = 'ABC Community Portal Account Forget Password';
            $message = 'Your account password has been replace with a new password.\n';
            $message .='New Password: '.$newpassword[0];
            $message = wordwrap($message, 70);
            $from = 'mdnurerfan105@gmail.com';
            $fromName = "Md Nur Erfan";
            
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mdnurerfan105@gmail.com';
                $mail->Password = 'Yakitate123';
                $mail->SMTPSecure = 'tls';
                
                $mail->FromName = $fromName;
                $mail->From = $from;
                $mail->AddAddress($to, $toName);
                $mail->Subject = $subject;
                $mail->Body = $message;
                
                $result = $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }
            //End of Email codes
            
            $formerror="New password have been sent to ".$email;
        }else{
            $formerror="Invalid email user";
        }
    }
}

?>
<html>
<link rel="stylesheet" href=".\css\pure-release-1.0.0\pure-min.css">
<body>

<h1>Forget Password</h1>
<form name="myForm" method="post" class="pure-form pure-form-stacked">
<table border='0' width="100%">
  <tr>    
    <td>Email</td>
    <td><input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30"></td>
	<td><?php echo $error_email?>
  </tr> 
  <tr>
    <td></td>
    <td><br><input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
    </td>
  </tr>
  <tr><p style="color:red;"> <?php echo $formerror?></p></tr>
</table>
</form>
<?php
include 'includes/footer.php';
?>