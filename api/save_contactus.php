<?php
require_once("../includes.php");
if(ISSET($_POST)){
	$cu_params = array();
	$cu_params['venue_id'] = ISSET($_REQUEST['venue'])?$_REQUEST['venue']:null;
	$cu_params['f_name'] = ISSET($_REQUEST['f_name'])?$_REQUEST['f_name']:null;
	$cu_params['isd_code'] = ISSET($_REQUEST['tel'])?$_REQUEST['tel']:null;
	$cu_params['mobile'] = ISSET($_REQUEST['phone'])?$_REQUEST['phone']:null;
	$cu_params['email'] = ISSET($_REQUEST['email'])?$_REQUEST['email']:null;
	$cu_params['comment'] = ISSET($_REQUEST['textmsg'])?$_REQUEST['textmsg']:null;
	$cu_params['privacy_flag'] = ISSET($_REQUEST['checkbox-2'])?true:false;
	$cu_params['newsletter_flag'] = ISSET($_REQUEST['checkbox-3'])?true:false;
}else{
	die("method not allowed");
}
$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];

$db = Database::getDatabase();
$cu_mandatory = array("venue_id","f_name","isd_code","mobile","email","comment");
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
if(!valid_email($cu_params['email'])){
	die("Invalid Email");
}

$sql_name = implode(",",$sql_name);
$sql_value = implode(",",$sql_value);
if(count($err_mandatory)>0){
	foreach($err_mandatory as $label){
		echo $label." is a mandatory field".PHP_EOL;
	}exit;
}

$row = $db->query("INSERT INTO contactus ($sql_name) VALUES ($sql_value)", $sql_params);
$n = new Newsletter();
$n->email = $cu_params['email'];
$n->insert();
echo "Saved!";

$f_name = $cu_params['f_name'];
$isd_code = $cu_params['isd_code'];
$mobile = $cu_params['mobile'];
$email = $cu_params['email'];
$comment = $cu_params['comment'];
$from = $cu_params['email'];
$from_name = $cu_params['f_name'];
$body = file_get_contents('../contactus_mail_template.php');
$body   = eval('return "' . addslashes($body) . '";');
$to=CONTACTUSTTO;
$subject="Contact Us";
//echo sendmail($from,$from_name,$to,$subject,$body);
if(defined('CONTACTUSTCC')){
	$cc=CONTACTUSTCC;
}
if(defined('CONTACTUSTBCC')){
	$bcc=CONTACTUSTBCC;
}
echo send_html_mail($to, $subject, $body, $from, $plaintext = '',$cc="",$bcc="");
exit;



    

?>