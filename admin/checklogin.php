<?php
session_start();
if(!empty($_POST['login'])){
	require_once 'db.php'; 
	
	$row = DB::query("SELECT * FROM members WHERE username=%s AND password=%s", $_POST['myusername'], md5($_POST['mypassword']));
	$count = DB::count();

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	$_SESSION['connect']='ok'; 
	header("location:index.php");
	}
	else {
	header("location:login.php?error=error");
	}
}
?>