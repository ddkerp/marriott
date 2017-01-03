<?PHP
require '../includes/master.inc.php';

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: index.php");

}
include("config.inc.php");  //include config file


?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<meta name='description' content='Read reviews about Marriottindiaweddings.com. Check all wedding destination, Wedding Ceremony, Reception Venue ratings, Wedding Travel reviews, Wedding Planning ratings all over India.'>
<meta name='keywords' content='Wedding Destination Testimonials, Wedding Destination Reviews, Wedding Destination Ratings, Wedding Reception Venue Testimonials, Wedding Reception Venue Reviews, Wedding Reception Venue Ratings, Wedding Planning Reviews, Wedding Planning Ratings'>
<title>Wedding Destination Testimonials, Reviews & Ratings | Wedding Ceremony, Reception Venue, Wedding Planning Reviews & Ratings</title>

<link rel="shortcut icon" href="images/favicon.ico">
<link href="css/bootstrap/bootstrap.css" type="text/css" rel="stylesheet">

<link href="css/layout.css" rel="stylesheet">
<link href="css/responsive.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="../Scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#results" ).load( "api_enquiry.php"); //load initial records
	
	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		var pagename = $("#tablewrapper").data("listing");
		$("#results").load("api_"+pagename+".php",{"page":page}, function(){ //get content from PHP page
			$(".loading-div").hide(); //once done, hide loading element
		});
		
	});
	$("#ad-nav-menu a").click(function(){
		var payload= $(this).attr("id");
		$("#results" ).load( "api_"+payload+".php", function( response, status, xhr ) {
			if ( status == "error" ) {
				var msg = "Sorry but there was an error: ";
				$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
			}else{
				//alert($('.dynoTable  .status:first').text());
				$('.dynoTable  .status').each(function(){
					if($(this).text() == 1){
						$(this).append('<button statid="0" class="butt-toggle butt-disable"></button>');
					}else{
						$(this).append('<button statid="1" class="butt-toggle butt-enable"></button>');
					}
				});

				$(document).on("click",".dynoTable  .butt-toggle",{},function(){
					var butt = $(this);
					var parent = $(this).parent();
					var formData = {
					'status' 				: butt.attr("statid"),
					'rev_id'				: $('td:first', butt.parents('tr')).text()
					
						};
					$.ajax({
						type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url 		: 'review_status.php', // the url where we want to POST
						data 		: formData
						
					})
					// using the done promise callback
						.done(function(data) {
							console.log(data); 
							 butt.toggleClass( "butt-enable butt-disable" );
							 var response = jQuery.parseJSON( data);
							 if(response.status==1){
								  parent.html(parent.html().replace("0","1"));
								 parent.find(":button").attr( "statid","0" );
							 }else{
								 parent.html(parent.html().replace("1","0"));
								 parent.find(":button").attr( "statid","1" );
							 }
							 
						})
						// using the fail promise callback
						.fail(function(data) {
							console.log(data);
							
						});
						
					
				});
			}
		});
		
		// 
		//$(".dynoTable .status").append() ("ddk");
		
	});
	
});
</script>
<style>
body,td,th {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #333;
}
.contents{
	margin: 20px;
	padding: 20px;
	list-style: none;
	background: #F9F9F9;
	border: 1px solid #ddd;
	border-radius: 5px;
}
.contents li{
    margin-bottom: 10px;
}
.loading-div{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.56);
	z-index: 999;
	display:none;
}
.loading-div img {
	margin-top: 20%;
	margin-left: 50%;
}

/* Pagination style */
.pagination{margin:0;padding:0;}
.pagination li{
	display: inline;
	padding: 6px 10px 6px 10px;
	border: 1px solid #ddd;
	margin-right: -1px;
	font: 15px/20px Arial, Helvetica, sans-serif;
	background: #FFFFFF;
	box-shadow: inset 1px 1px 5px #F4F4F4;
}
.pagination li a{
    text-decoration:none;
    color: rgb(89, 141, 235);
}
.pagination li.first {
    border-radius: 5px 0px 0px 5px;
}
.pagination li.last {
    border-radius: 0px 5px 5px 0px;
}
.pagination li:hover{
	background: #CFF;
}
.pagination li.active{
	background: #F0F0F0;
	color: #333;
}

</style>
    </head>
    <body>

	<header>  
		<a href="../admin"><img src="images/logo.png" alt="Marriott" title="Marriott"></a>
		<ul class="menu-right">
			<li><a href="javascript:;"><img src="images/user.png" alt="User" title="User"> Welcome <?php echo $_SESSION['login']; ?>!</a></li>
			<li style="padding-top: 5px;"><a href="logout.php">Logout</a></li>	
		</div>
		</ul>
	</header>
	<section class="wrapper bg-white"> 
		<div class="content-block"> 
			<menu id="ad-nav-menu"><ul><li><a id="enquiry" href="#">Enquiry</a><li><li><a href="#" id="review">Review</a></li></ul></menu>
			<div class="container report" id="results">
			</div>
			<div class="fl-right" style="text-align: center;">
				<a href="exportexcel.php" id="btLogin" class="btn btn-primary mB10 planner-login" type="submit" style="vertical-align:middle">Export As Excel</a>
			</div>
		</div>
    </section>
    </body>
</html>
    