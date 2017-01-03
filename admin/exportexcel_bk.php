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
    	<th>Id</th>
		<th>Name</th>
		<th>Mobile</th>
		<th>Email</th>
		<th>Message</th>
		<th>Hotel</th>
	</tr>
	<?php

	
	//query get data
	$sql = mysql_query("select id,name,mobile,email,message,(select hotel_name from hotel_master where id=g.hotel) as hotel from get_in_touch g");
	$no = 1;
	while($data = mysql_fetch_array($sql)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['name'].'</td>
			<td>'.$data['mobile'].'</td>
			<td>'.$data['email'].'</td>
			<td>'.$data['message'].'</td>
			<td>'.$data['hotel'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>