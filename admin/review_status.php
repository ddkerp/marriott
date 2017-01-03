<?php
require '../includes/master.inc.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$cu_params = array();
	$cu_params['status'] = ISSET($_REQUEST['status']) && $_REQUEST['status']==1?$_REQUEST['status']:null;
	$cu_params['rev_id'] = ISSET($_REQUEST['rev_id'])?$_REQUEST['rev_id']:null;
}else{
	die("method not allowed");
}

$review = new Review();
$review->columns = array("status"=>$cu_params['status']);
$review->id = $cu_params['rev_id'];
$review->update();

$review = new Review();
$review->select($cu_params['rev_id'],"id");
$status = $review->columns['status'];
echo json_encode(array("status"=>$status));
exit;
?>