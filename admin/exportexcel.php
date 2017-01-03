<?PHP
session_start();
ob_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: index.php");

}


$conn=mysql_connect('localhost','marriou2_wedding','69JqB5gT8rlF');
$db=mysql_select_db('marriou2_marriott',$conn);

?>
<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=getintouch.xls");
 

?>
<table border="1">
    <tr>
    	<th>Sl.No</th>
    	<th>Date</th>
		<th>Name</th>
		<th>Email ID</th>
		<th>Property</th>
		<th>Comment</th>
		
	</tr>
	<?php

	
	//query get data
	$sql = mysql_query("select id,name,mobile,email,message,(select hotel_name from hotel_master where id=g.hotel) as hotel,inserted_time from get_in_touch g order by id DESC");
	$no = 1;
	while($data = mysql_fetch_array($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>';
			if($data['inserted_time'] != "0000-00-00 00:00:00")
		{
		echo '<td>'.$newDate = date("d/m/Y", strtotime($data['inserted_time'])).'</td>';	
		}
		else
		{
			echo '<td>-</td>';
		}
			echo '<td>'.$data['name'].'</td>
			<td>'.$data['email'].'</td>
			
			<td>'.$data['hotel'].'</td>
			<td>'.$data['message'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>