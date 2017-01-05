<?php
require_once("../includes.php");
//printr($_REQUEST);exit;
if(ISSET($_POST)){
	//echo "<pre>";print_r($_POST);exit;
	$cu_params = array();
	$cu_params['user_name'] = ISSET($_POST['first_name'])?$_POST['first_name']:null;
	$cu_params['email'] = ISSET($_POST['email_address'])?$_POST['email_address']:null;
	$cu_params['venue_id'] = ISSET($_POST['venueid'])?$_POST['venueid']:null;
	$cu_params['phone'] = ISSET($_POST['mobile_number'])?$_POST['mobile_number']:null;
	$cu_params['review_text'] = ISSET($_POST['reviewmessage'])?$_POST['reviewmessage']:null;
	$cu_params['review_subject'] = ISSET($_POST['reviewsubject'])?$_POST['reviewsubject']:null;
}else{
	die("method not allowed");
}
$cu_params['status'] = false;
$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];

$db = Database::getDatabase();
$cu_mandatory = array("venue_id","user_name","email","phone","review_text");
$err_mandatory = array();
$sql_name = array();
$sql_value = array();
foreach ($cu_params as $key=>$value){
	if(in_array($key,$cu_mandatory) && (is_null($value) || $value=="")){
		$err_mandatory[] = $key;
	}
	$sql_name[] = $key;
	$sql_value[] = ":".$key.":";
	$sql_params[$key] = $value;
}
$sql_name = implode(",",$sql_name);
$sql_value = implode(",",$sql_value);
if(count($err_mandatory)>0){
	foreach($err_mandatory as $label){
		echo $label." is a mandatory field";
	}exit;
}

$row = $db->query("INSERT INTO review ($sql_name) VALUES ($sql_value)", $sql_params);
exit;

?>