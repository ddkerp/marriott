<?php
require_once("../includes.php");
//printr($_REQUEST);exit;
if(ISSET($_POST)){
	//echo "<pre>";print_r($_POST);exit;
	$cu_params = array();
	$cu_params['venue_id'] = ISSET($_POST['venueid'])?$_POST['venueid']:null;
	$cu_params['name'] = ISSET($_POST['first_name'])?$_POST['first_name']:null;
	$cu_params['email'] = ISSET($_POST['email_address'])?$_POST['email_address']:null;
	$cu_params['phone'] = ISSET($_POST['mobile_number'])?$_POST['mobile_number']:null;
	$cu_params['from_page'] = ISSET($_POST['page'])?$_POST['page']:null;
}else{
	die("method not allowed");
}
$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];

$db = Database::getDatabase();
$cu_mandatory = array("venue_id","name","email","phone");
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

$row = $db->query("INSERT INTO enquiry_master ($sql_name) VALUES ($sql_value)", $sql_params);
exit("saved!");

?>