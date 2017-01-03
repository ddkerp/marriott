<?php
session_start();
// Establishing connection with server..
 $connection = mysql_connect("localhost", "root", "");

// Selecting Database 
 $db = mysql_select_db("marriou2_marriott", $connection);

//Fetching Values from URL  
$email=$_POST['email1'];
$password= md5($_POST['password1']);  // Password Encryption, If you like you can also leave sha1

//matching user input email and password with stored email and password in database
	$result = mysql_query("SELECT * FROM user_master WHERE username='$email' AND password='$password'");
    $data = mysql_num_rows($result);
	       
	if($data==1)
      {
		 $_SESSION['login'] = $email;
		 echo "Successfully Logged in...";    
	  } 
	else
	{
		echo "Email or Password is wrong...!!!!";
	}  
 
 
//connection closed
mysql_close ($connection);
?>