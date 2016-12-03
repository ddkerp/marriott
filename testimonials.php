<?php
require_once("includes.php");
$db  = Database::getDatabase();
$rows = $db->getRows("SELECT * FROM testimonials WHERE status=1 ORDER BY sort ASC");
$i=1;
$testimonials = "";
foreach($rows as $row){
	if($i%2==0){
		$testimonials = $testimonials.'<div class="row margin-T30 margin-B100 randomTesti revealOnScroll delay-100" data-animation="fadeInUpShort">
							<div class="col-md-7 col-sm-7 col-xs-12 t_quotation ">
								<div class="row">
									<h3 class="text-center margin-B30">'.$row['title'].'</h3>
									<p class="text-center line-height-md">"'.$row['description'].'"
										<br />
										<br />
										<span> - '.$row['user_name'].'</span></p>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="col-md-5 col-sm-5">
								<div class="row"> <img src="Images/testimonials/'.$row['user_image'].'" class="img-responsive" alt="Testimonial" /></div>
							</div>
						</div>';
	}else{
		$testimonials = $testimonials.'<div class="row margin-T30 margin-B100 randomTesti revealOnScroll delay-100" data-animation="fadeInUpShort">
							<div class="col-md-5 col-sm-5 ">
								<div class="row"> <img src="Images/testimonials/'.$row['user_image'].'" class="img-responsive" alt="Testimonial" /></div>
							</div>
							<div class="col-md-7 col-sm-7 col-xs-12 t_quotation ">
								<div class="row">
									<h3 class="text-center margin-B30">'.$row['title'].'</h3>
									<p class="text-center line-height-md">"'.$row['description'].'"
										<br />
										<br />
										<span> - '.$row['user_name'].'/span></p>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>';
	}
	$i++;
}
			
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title><link href="Images/favicon.png" rel="shortcut icon"><link href="CSS/style.css" rel="stylesheet" type="text/css" /><script src="Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
</head>

<body>
    <div class="loader"></div>
    <!-- Header -->
    <header id="testimonials">
        <div class="container-fluid" id="banner">
            <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item t_banner active "> <img src="Images/testimonial_banner.jpg" alt="..." >
                            <div class="carousel-caption hide">
                                <div class="pull-left col-sm-6 col-sm-12 text-left">
                                    <h3>Testimonials</h3>
                                </div>
                                <div class="pull-right col-sm-6 col-sm-12 text-right "> <i class="icon-rating-medium icon-md"></i><span class="">4.5</span> <i class="icon-share-medium icon-md bgliac"></i> <i class="icon-start-planning-medium icon-md bgliac"></i> <i class="icon-visit-website-medium icon-md bgliac"></i> </div>
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
    <section id="title">
     <div class="container margin-T30">
         <h3 class="text-center revealOnScroll slow" data-animation="fadeInUpShort">Testimonials</h3>
                <p class="text-center revealOnScroll slow" data-animation="fadeInUpShort"><i class="icon-decor-glyph-medium liac icon-lg"></i></p>
        </div>
        </section>
    <!-- testimonials Starts-->
    <section id="testimonials_page" class="bgWhite">
        <div class="container animations">
       
            <?php echo $testimonials;?>
		 
       
	   </div>
    </section>
    <div class="clearfix"></div>

    <!-- Footer -->
   
   <footer id="footer_full">&nbsp;</footer> 
   <!-- // Footer -->
    <script src="Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>-->
   <script>
	 /* (function () {
   "use strict";
    // Cycle over each .shuffledv HTMLElement
    $(".animations").each(function () {
        // Remove all divs within, store in $d
       var $d = $(this).find(".randomTesti").remove();
         Sort $d randomnly
        $d.sort(function () { return Math.floor(Math.random() * $d.length); });
        Append divs within $d to .shuffledv again
        $d.appendTo(this);
   });
}());*/
	</script>
    <!-- Tracking Code -->
<script src='https://static.getclicky.com/js'></script><script>try {clicky.init(100849934);} catch (e) {}</script><noscript><img height='1' width='1' src='http://static.getclicky.com/100849934ns.gif' /></noscript>
<script type='text/javascript' langauge='javascript'>document.write(unescape("%3Cscript src='" + "Scripts/sslpathanalyzer.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type='text/javascript' langauge='javascript'>fnTrackUrl('51620749-5585-420a-baf3-097a1bf718ac');</script>
    <!-- Tracking Code -->
</body>

</html>