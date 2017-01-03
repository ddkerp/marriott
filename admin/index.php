<?PHP
require '../includes/master.inc.php';
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
}else{
	header ("Location: dashboard.php");
}
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
<link href="../CSS/bootstrap/bootstrap.css" type="text/css" rel="stylesheet">
<link href="../CSS/bootstrap/bootstrap-select.css" type="text/css" rel="stylesheet">
<link href="../CSS/libs/jquery-ui.css" type="text/css" rel="stylesheet">
<link href="../CSS/jquery.bxslider.css" rel="stylesheet">
<link href="css/layout.css" rel="stylesheet">
<link href="css/development_layout.css" type="text/css" rel="stylesheet">
<link href="../CSS/libs/jquery.classyscroll.css" rel="stylesheet">
<link href="css/responsive.css" type="text/css" rel="stylesheet">
<!--<link href="css/datepicker.css" type="text/css" rel="stylesheet">-->
<link href="../CSS/libs/jquery.ptTimeSelect.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="../Scripts/libs/crop/jquery.cropbox.css" type="text/css">
	<!-- include JavaScript file here-->
	<script src="../Scripts/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
<!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
    </head><body>
<header>  <img src="images/logo.png" alt="Marriott" title="Marriott">

</header>    
    <section class="wrapper  bg-black"> 
 
  
  <div class="content-block"> 
      <div class="container">
            <div class="login-stage">
            <h1>Wedding Planner</h1>
            <input type="text" name="user_email_login" id="user_email_login" placeholder="Username" autocomplete="off">
                <input type="password" name="user_password_login" id="user_password_login" placeholder="Password" autocomplete="off" maxlength="32">
                <button type="button" class="btn btn-primary mB10 planner-login" id="login">Login</button><br/>
                
            </div>
      </div>
      </div>
  
</section>
    </body></html>