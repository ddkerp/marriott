<?php
require_once("../includes.php");

$cu_params['ip_address'] = $_SERVER['REMOTE_ADDR'];

$db = Database::getDatabase();
$venues = $db->getRows("SELECT name,id FROM venue");

foreach($venues as $venue){
	$data[] = array("name"=>$venue['name'],"id"=>$venue['id']);
}
header('Content-Type: application/json');
echo json_encode($data);

exit;


?>