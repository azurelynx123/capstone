<?php
use classes\business\UserManager;
use classes\business\Validation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'includes/autoload.php';
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
    <head>
        <title>Forget Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="bs/css/bootstrap.min.css">
        <script src="bs/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

    </head>
    <body style="min-height: 100vh; background-image: url(images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">

        <br>
        <div class="col-lg-4 col-lg-offset-4" style="background-color: rgba(255, 255, 255, 0.8)">
            <div class="container-fluid" style="min-height: 300px">
                <h1 style="text-align: center">Forget Password</h1>
                <br>
                <p style="text-align: center">Enter the email you registerd with. We will send an email to you with a new account password if we find the account associated with the email entered.<br><br>
                <center>
                    <form name="myForm" method="post" class="pure-form pure-form-stacked">
                        <table border='0' width="100%">
                        <tr><td><center>Email: <input type="email" name="email" value="<?=$email?>" pattern=".{1,}"   required title="Cannot be empty field" size="30"></center></td></tr>
                        <tr><td><?php echo $error_email?></td></tr>
                        <tr><td><br></td><tr>
                        <tr>
                            <td><center>
                                <input type="submit" name="submitted" value="Submit" class="pure-button pure-button-primary">
                                <span>  </span>
                                <input type="reset" value="Cancel" class="pure-button pure-button-primary">
                            </center></td>
                        </tr>
                        <tr><p style="color:red;"><?php echo $formerror?></p></tr>
                        </table>
                    </form>
                </center>
                <br>
            </div>
        </div>
    </body>
</html>

<?php
include 'includes/footer.php';
?>