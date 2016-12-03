<?php
require_once("../includes.php");
if(ISSET($_POST)){
	$cu_params = array();
	$cu_params['email'] = ISSET($_REQUEST['email'])?$_REQUEST['email']:null;
}else{
	die("method not allowed");
}
$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];
$n = new Newsletter();
$n->email = $cu_params['email'];
$n->insert();
exit("Saved!");

?>