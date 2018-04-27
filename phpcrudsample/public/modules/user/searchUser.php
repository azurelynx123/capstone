<?php
session_start();
require_once '../../includes/autoload.php';

use classes\business\UserManager;
use classes\entity\User;

ob_start();
// include '/../../classes/business/UserManager.php';
include '../../includes/security.php';
include '../../includes/header.php';
?>
<br/>
<link rel="stylesheet" href="..\..\css\pure-release-1.0.0\pure-min.css">
<title>Search results</title>
<form action="searchUser.php" method="get" class="pure-form pure-form-stacked">
	<table border='0' width="100%">
		<tr>
			<td><input type="text" placeholder="Find other users" name="search" />
			<td><input type="submit" value="Search" class="pure-button pure-button-primary" />
		<tr />
	</table>
<form />

<?php
$query = $_GET['search'];

if(strlen($query)!=0){
    $UM = new UserManager();
    $users = $UM->searchUser($query);
}

if (isset($users) && $users!=FALSE) {
?>
		<br/>
		Below is the list of Developers registered in community portal
		<br/>
		<b>Results Found for:</b><?php echo " ".$query?>
		<table class="pure-table pure-table-bordered" width="800">
			<tr>
			<thead>
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
        if ($user != null) {
            ?>
            <tr>
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
    </table>
    <?php 
} else {
    if (strlen($query)!=0){
        
    
    ?>
    <br />
    <br />
    <table class="pure-table pure-table-bordered" width="800">
    	<tr><td><b>No Results Found for:</b><?php echo " ".$query?></td></tr>
    </table>  
<?php
    } else {
?>
        <br />
        <br />
        <table class="pure-table pure-table-bordered" width="800">
        <tr><td><b>Please fill the search box.</td></tr>
    </table>
<?php 
    }
}
include '../../includes/footer.php';
?>