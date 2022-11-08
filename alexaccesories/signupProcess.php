<?php
if(isset($_POST['save'])){
	require_once("signupConfig.php");
	$sc= new signupConfig();

	$sc -> setusername($_POST['username']);
	$sc-> setemailaddress($_POST['emailaddress']);
	$sc-> setphonenumber($_POST['phonenumber']);
	$sc->  setrole($_POST['role']);
	$sc-> setpassword($_POST['password']);
	$sc-> insertData();
	echo"<script>alert('data saved successfully');document.location='allData.php'</script>";
}
?>