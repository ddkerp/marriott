<?php

require '../includes/master.inc.php';
//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("config.inc.php");  //include config file
	//Get page number from Ajax POST
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	$results = $mysqli->query("SELECT COUNT(*) FROM contactus");
	$get_total_rows = $results->fetch_row(); //hold total records in variable
	//break records into pages
	$total_pages = ceil($get_total_rows[0]/$item_per_page);
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	

	//Limit our results within a specified range. 
	$stmt = $mysqli->prepare("SELECT c.id,c.f_name,concat(IFNULL(c.isd_code,''),c.mobile),c.email,c.comment,c.privacy_flag,c.from_page,c.newsletter_flag,c.ip_address,c.created_on,(select name from venue where id=c.venue_id) as venue_name FROM contactus c ORDER BY c.id DESC LIMIT $page_position, $item_per_page");
	$stmt->execute(); //Execute prepared Query
	//$results->bind_result($name, $email, $message, $hotel,$inserted_time); //bind variables to prepared statement
	//$source = $inserted_time;
	//$date = new DateTime($source);
	$rows = fetch_assoc_stmt($stmt);

	$headers = array("S.No","Name","Mobile","Email Id","Comment","Privacy Flag","From Page","News Letter Flag","IP Address","Contacted Date","Venue");
	
	echo '<h1>Enquiry</h1>
	<h6>MARRIOTT WEDDING: Enquiry</h6>
	<div class="table-responsive" id="tablewrapper" data-listing="enquiry">';
	echo getTable($headers,$rows,$page_position);
	echo ' </div>';
	echo '<div class="fl-right" style="text-align: center;">Total Leads: <strong>'.$get_total_rows[0].'</strong></div>';
	echo '<div align="center">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
	echo '</div>';
	exit;
}

?>

