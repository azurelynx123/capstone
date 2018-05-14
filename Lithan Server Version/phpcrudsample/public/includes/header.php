<style>
a {
    margin: auto;
}
</style>

<!-- Navigation Bar -->
<?php
if (isset($_SESSION["email"])) {
    if ($_SESSION["role"] == "admin") {
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-white w3-large">
	<img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="max-height: 35px">
	<a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile">Home</a>
	<a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
	<a href="/phpcrudsample/public/modules/user/userlist.php" class="w3-bar-item w3-button w3-mobile">View/Edit Users</a>
	<a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
	<a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div>
<?php
    } else {
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-white w3-large">
	<img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="max-height: 35px"> 
	<a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile">Home</a>
	<a href="/phpcrudsample/public/modules/user/updateprofile.php" class="w3-bar-item w3-button w3-mobile">Update Profile</a>
	<a href="/phpcrudsample/public/modules/user/userlist.php" class="w3-bar-item w3-button w3-mobile">View/Search Users</a>
	<a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
	<a href="/phpcrudsample/public/logout.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Logout</a>
</div>
<?php
    }
} else {
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-bar w3-white w3-large">
	<img src="http://localhost/phpcrudsample/public/images/logo.png" align="left" style="max-height: 35px"> 
	<a href="/phpcrudsample/public/home.php" class="w3-bar-item w3-button w3-mobile">Home</a> 
	<a href="/phpcrudsample/public/aboutus.php" class="w3-bar-item w3-button w3-mobile">About Us</a> 
	<a href="/phpcrudsample/public/contactus.php" class="w3-bar-item w3-button w3-mobile">Contact</a> 
	<a href="/phpcrudsample/public/login.php" class="w3-bar-item w3-button w3-right w3-light-grey w3-mobile">Login</a>
</div>
<?php
}
?>