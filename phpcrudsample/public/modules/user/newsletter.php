<?php
session_start();
use classes\business\UserManager;
use classes\business\Validation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../includes/autoload.php';
include '../../includes/security.php';
include '../../includes/header.php';

require '../../includes/PHPMailer/src/Exception.php';
require '../../includes/PHPMailer/src/PHPMailer.php';
require '../../includes/PHPMailer/src/SMTP.php';

$recipientIdArray = [];
$recipientEmailArray = [];

$recipientIdArray = $_SESSION['recipientId'];
$recipientEmailArray = $_POST["emailList"];
$recipientFullNameArray = $_SESSION['recipientFullName'];

//Test variables
// echo "Recipients Ids: ".implode(", ", $recipientIdArray)."<br>";
// echo "Recipients Emails: ".$recipientEmailArray."<br>";
// echo "Recipient Full Names: ".implode(", ", $recipientFullNameArray)."<br>";
// echo "Email Content: ".$_POST["emailContent"]."<br>";

$recipientEmailArray = explode(", ", $recipientEmailArray);

$rootLink = "http://localhost/phpcrudsample/public/modules/user/";
$link = $rootLink."unsubscribe.php?id=";
$valhas = "";

$subject = 'ABC Community Portal Newsletter';
$message = $_POST["emailContent"].'<hr>';
$message = wordwrap($message, 70);
$from = 'mdnurerfan105@gmail.com';
$fromName = "Admin";

$mail = new PHPMailer(true);
for ($i=0; $i<sizeof($recipientEmailArray); $i++){
    try {
        $valhas = md5($recipientIdArray[$i]);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mdnurerfan105@gmail.com';
        $mail->Password = 'Yakitate123';
        $mail->SMTPSecure = 'tls';
        
        $mail->FromName = $fromName;
        $mail->From = $from;
        $mail->AddAddress($recipientEmailArray[$i], $recipientFullNameArray[$i]);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message."To stop receiving newsletters and updates click <a href=".$link.$recipientIdArray[$i]."&valhas=".$valhas.">Unsubscribe</a>"."<br>";
        
        $result = $mail->send();
        $mail->ClearAddresses();
        echo $result ? 'Pass' : 'Fail';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
unset($_SESSION['recipientId']);
unset($_SESSION['recipientFullName']);
?>

<?php include '../../includes/footer.php'; ?>