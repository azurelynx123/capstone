<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
// include '/../../classes/business/UserManager.php';
include '../../includes/security.php';
include '../../includes/header.php';

$UM=new UserManager();
$users=$UM->getAllUsers();

?>
<head>
    <title>List of Users</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../bs/css/bootstrap.min.css">
    <script src="../../bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
</head>
<body style="min-height: 100vh; background-image: url(../../images/background.jpg); background-repeat: repeat; background-size : 100% auto; background-attachment: fixed">
<br>
<div class="container-fluid" style="background-color: rgba(255, 255, 255, 0.8); width: max-content;">
<br/>
<form action="searchUser.php" method="get" class="pure-form pure-form-stacked">
	<table border:"0" width="800">
	<tr>
        <td><input type="text" placeholder="Find other users" name="search" /></td>
        <td><input type="submit" value="Search" class="pure-button pure-button-primary"/></td>
    <tr/>
    <table/>
</form>
<?php
if(isset($users)){
    ?>
	<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">

    <br/>
    Below is the list of Developers registered in community portal
    <br/>
    <table class="pure-table pure-table-bordered" width="800">
    <tr>
	<thead>
    <?php if($_SESSION['role'] == "admin"){ ?>
        <th></th>
    <?php } ?>
    	<th><b>Id</b></th>
    	<th><b>First Name</b></th>
    	<th><b>Last Name</b></th>
    	<th><b>Email</b></th>
    	<?php if($_SESSION['role'] == "admin"){ ?>
			<th><b>Edit</b></th>
			<th><b>Operation</b></th>
		<?php } ?>
	</thead>
    </tr>
        
    <?php 
    foreach ($users as $user) {
        if($user!=null){
            if($user->id == $_SESSION['id']){
                continue;
            }
            ?>
            <tr>
            <?php if($_SESSION['role'] == "admin"){ ?>
                <form method="post" class="pure-form pure-form-stacked">
            <?php if($user->subscribe != false) {  ?>
                    <td align="center" bgcolor="#FFFFFF"><input name="check[]" type="checkbox" class="case" value="<?php echo $user->id; ?>"></td>
            <?php } else { ?>
                <td align="center" bgcolor="#FFFFFF"><input name="check[]" type="checkbox" value="<?php echo $user->id; ?>" disabled></td>
            <?php } ?>
            <?php } ?>
               <td><?=$user->id?></td>
               <td><?=$user->firstName?></td>
               <td><?=$user->lastName?></td>
               <td><?=$user->email?></td>
               <?php if($_SESSION['role'] == "admin"){ ?>
			   		<td><a href='updateAnotherProfile.php?id=<?php echo $user->id ?>'>Edit</a></td>
			   		<td><a href='deleteuser.php?id=<?php echo $user->id ?>'>Delete</a></td>
			   <?php } ?>
            </tr>
            <?php 
        }
    }
    ?>
    </table><br/>
    
    <?php if($_SESSION['role'] == "admin"){ ?>
        <input type="submit" value="Email Checked Personnel" name ="bulkMail" class="pure-button pure-button-primary"/>
        </form>
        <br/><br/>
    <?php } ?>

    <?php
    if(isset($_POST["bulkMail"])){
        if(!isset($_POST["check"])){
            echo "<script>alert('Please select users to email to.');</script>";
        } else {
            $checkedArray = $_POST["check"];
            $emailArray = [];
            $emailNameArray = [];
            //Array of recipient emails
            foreach ($checkedArray as $id){
                array_push($emailArray, $UM->getEmailById($id));
            }
            //Array of recipient full names
            foreach ($emailArray as $userEmail){
                array_push($emailNameArray, $UM->getNameByEmail($userEmail));
            }
            $emailString = implode(", ", $emailArray);
            $_SESSION['recipientId'] = $checkedArray;
            $_SESSION['recipientFullName'] = $emailNameArray;
            ?>
            <form method="post" action="newsletter.php">
                <table width="800">
                    <tr>
                        <td>Recepients</td>
                        <td><input type="text" name="emailList" value='<?=$emailString?>' size="70%" readonly/></td>
                    </tr>
                    <tr>
                        <td>Content</td>
                        <td><textarea name="emailContent" style="width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"></textarea></td>
                    </tr>
                </table>
                <input type="submit" value="Send" name ="sendMail" class="pure-button pure-button-primary"/>
            </form>
        <?php
        }
    }
}
?>
</div>
<?php
include '../../includes/footer.php';
?>