<?php
require_once("../includes.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//echo "<pre>";print_r($_POST);exit;
	$cu_params = array();
	$cu_params['venue_id'] = ISSET($_REQUEST['venueid'])?$_REQUEST['venueid']:null;
	$cu_params['f_name'] = ISSET($_REQUEST['first_name'])?$_REQUEST['first_name']:null;
	$cu_params['email'] = ISSET($_REQUEST['email_address'])?$_REQUEST['email_address']:null;
	$cu_params['mobile'] = ISSET($_REQUEST['mobile_number'])?$_REQUEST['mobile_number']:null;
	$cu_params['from_page'] = ISSET($_REQUEST['page'])?$_REQUEST['page']:null;
	$cu_params['newsletter_flag'] = 0;
	$cu_params['privacy_flag'] = 0;
}else{
	die("method not allowed");
}
$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];

$db = Database::getDatabase();
$cu_mandatory = array("venue_id","f_name","email","mobile");
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

$row = $db->query("INSERT INTO contactus ($sql_name) VALUES ($sql_value)", $sql_params);

$venue_detail = $db->getRow("SELECT * FROM venue where id = " . $db->quote($cu_params['venue_id']));
$venue_name = $venue_detail['name'];
$f_name = $cu_params['f_name'];
$mobile = $cu_params['mobile'];
$email = $cu_params['email'];
$from = $cu_params['email'];
$from_name = $cu_params['f_name'];
$from_page = $cu_params['from_page'];
$base_url=base_url();
$body = file_get_contents('../enquiry_mail_template.php');
$body   = eval('return "' . addslashes($body) . '";');
if($venue_detail['associate_mailid']!=""){
	$tomail = $venue_detail['associate_mailid'];
}else{
	$tomail = CONTACTUSTTO;
}
$to=array($tomail);
$subject="Contact Us";
if(defined('CONTACTUSTCC')){
	$cc=array(CONTACTUSTCC);
}
if(defined('CONTACTUSTBCC')){
	$bcc=array(CONTACTUSTBCC);
}
echo sendmail($from,$from_name,$to,$subject,$body,$cc,$bcc);
exit;


exit("saved!");

?>