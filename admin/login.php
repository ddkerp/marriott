<?php


require '../includes/master.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	$db  = Database::getDatabase();
	$id = ISSET($_REQUEST["id"])?$_REQUEST["id"]:null;

	$user=$_POST['email1'];
	$pass= md5($_POST['password1']);  // Password Encryption, If you like you can also leave sha1
	$row = $db->getRow("SELECT * FROM user_master WHERE username=" . $db->quote($user) ." AND password=".$db->quote($pass)); 
	if($db->hasRows()){
		$_SESSION['login'] = $user;
		echo "Successfully Logged in..."; 
	}else{
		echo "Email or Password is wrong...!!!!";
	}
}else{
	die("method not allowed");
}


exit;

?>