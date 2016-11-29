<?php
require_once("includes.php");
//printr($_REQUEST);exit;
$cu_params = array();
$cu_params['venue_id'] = ISSET($_REQUEST['venue'])?$_REQUEST['venue']:null;
$cu_params['f_name'] = ISSET($_REQUEST['f_name'])?$_REQUEST['f_name']:null;
$cu_params['isd_code'] = ISSET($_REQUEST['tel'])?$_REQUEST['tel']:null;
$cu_params['mobile'] = ISSET($_REQUEST['phone'])?$_REQUEST['phone']:null;
$cu_params['email'] = ISSET($_REQUEST['email'])?$_REQUEST['email']:null;
$cu_params['comment'] = ISSET($_REQUEST['textmsg'])?$_REQUEST['textmsg']:null;
$cu_params['privacy_flag'] = ISSET($_REQUEST['checkbox-2'])?true:false;
$cu_params['newsletter_flag'] = ISSET($_REQUEST['checkbox-3'])?true:false;
$db = Database::getDatabase();
$cu_mandatory = array("venue_id","f_name","isd_code","mobile","email","comment");
$err_mandatory = array();
$sql_name = array();
$sql_value = array();
//printr($cu_params);
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
//printr($err_mandatory);exit;
//echo "INSERT INTO contactus ($sql_name) VALUES ($sql_value)";exit;

$row = $db->query("INSERT INTO contactus (venue_id,f_name,isd_code,mobile,email,comment,privacy_flag,newsletter_flag) VALUES (:venue_id:,:f_name:,:isd_code:,:mobile:,:email:,:comment:,:privacy_flag:,:newsletter_flag:)", $sql_params);

?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title><link href="Images/favicon.png" rel="shortcut icon"><link href="CSS/style.css" rel="stylesheet" type="text/css" /><script src="Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
</head>

<body class="bgGrey-lighter3 thankyou">
    <div class="loader"></div>
    <!-- Header -->
    <header id="thankyou">
        <div class="container-fluid" id="banner">
            <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item ty_banner active "> <img src="Images/thankyou_banner.jpg" alt="...">
                            <div class="carousel-caption">
                                <div class="pull-left col-sm-6 col-sm-12 text-left hide"> Thank you </div>
                                <div class="pull-right col-sm-6 col-sm-12 text-right hide"> <i class="icon-rating-medium icon-md"></i><span class="">4.5</span> <i class="icon-share-medium icon-md bgliac"></i> <i class="icon-start-planning-medium icon-md bgliac"></i> <i class="icon-visit-website-medium icon-md bgliac"></i> </div>
                                <div class="clearfix"></div>
                                <div class="padding20 bgWhite ">
                                    <div class="padding20 border1px border-grey-medium"> <i class="icon-hand-shake-xlarge icon-xl bgliac"></i>
                                        <h3 class="text-center revealOnScroll slow" data-animation="fadeInUp">Thank you for getting in touch!</h3>
                                        <p class="text-center margin-T20 revealOnScroll slow" data-animation="fadeInUp">We have received your message and would like to thank you for writing to us. </p>
                                        <p class="text-center res_text revealOnScroll slow" data-animation="fadeInUp">If your inquiry is urgent, please use the telephone number listed below, to talk to one of our staff members. Otherwise, we will reply by email shortly. Talk to you soon.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Wrapper for slides -->
                </div>
            </div>
        </div>
       
		 <!-- Nav menus -->
       <div id="header_Menu"></div>
        <!-- Nav menus -->
		
		<div class="clearfix"></div>
        <div class="responsive_search_small">
            <div class="col-xs-12">
                <input name="search" type="text" class=" form-control inputbox input-xlarge" placeholder="Search..." />
                <i class="icon-search-small icon-md liac"></i> </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </header>
    <!-- // Header -->

    <div class="clearfix"></div>
    <!-- Thankyou  Starts-->
    <section id="thankyou_page" class="bgGrey-lighter3 hide animatedParent">
        <div class="container">
            <div class="row margin-T100 margin-B150">
                <h3 class="text-center animated fadeInUp slow">Thank you for getting in touch!</h3>
                <p class="text-center margin-T50 animated fadeInRight slow">We have received your message and would like to thank you for writing to us. </p>
                <p class="text-center res_text animated fadeInRight slow">If your inquiry is urgent, please use the telephone number listed below, to talk to one of our staff members. Otherwise, we will reply by email shortly. Talk to you soon.</p>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>

    <!-- Footer -->
   <footer id="footer_full">&nbsp;</footer> 
   <!-- // Footer -->

    <script src="Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>-->
    <script>
        setTimeout(function() {
            window.location = 'index.html';
        }, 10000);
    </script>

    <!-- Tracking Code -->
<script src='https://static.getclicky.com/js'></script><script>try {clicky.init(100849934);} catch (e) {}</script><noscript><img height='1' width='1' src='http://static.getclicky.com/100849934ns.gif' /></noscript>
<script type='text/javascript' langauge='javascript'>document.write(unescape("%3Cscript src='" + "Scripts/sslpathanalyzer.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type='text/javascript' langauge='javascript'>fnTrackUrl('51620749-5585-420a-baf3-097a1bf718ac');</script>
    <!-- Tracking Code -->
</body>

</html>