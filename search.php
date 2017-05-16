<?php
require_once("includes.php");
$db  = Database::getDatabase();

$_POST
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
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'>
<meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'>
<title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title>
<link href="Images/favicon.png" rel="shortcut icon">
<link href="CSS/style.css" rel="stylesheet" type="text/css" />
<script src="Scripts/modernizr.custom.js"></script>
 
</head>

<body class="bgGrey-lighter3">
<div class="loader"></div>
<!-- Header -->
<header id="blog">
  <div class="container-fluid" id="banner">
    <div class="row">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item t_banner active "> <img src="Images/blog_banner.jpg" alt="..." >
            <div class="carousel-caption hide">
              <div class="pull-left col-sm-6 col-sm-12 text-left">
                <h3>blog</h3>
              </div>
              <div class="pull-right col-sm-6 col-sm-12 text-right hide"> <i class="icon-rating-medium icon-md"></i><span class="">4.5</span> <i class="icon-share-medium icon-md bgliac"></i> <i class="icon-start-planning-medium icon-md bgliac"></i> <i class="icon-visit-website-medium icon-md bgliac"></i> </div>
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
      <i class="icon-search-small icon-md liac"></i> 
	  
	  
	  </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</header>
<!-- // Header -->
<section id="site_search" class="">
      <div class="container">
    <div class="row margin-T50">
          <div class="margin-B10 venue_list searchbar ">
        
        
        <div class="col-md-12">
    		
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control searchbar-input  input-lg" placeholder="What are you looking for ?">
                     <span class="input-group-btn">
                        <select class="form-control" >
						<option value="1">All</option>
						<option value="1">Property</option>
						<option value="1">Description</option>
						<option value="1">Address</option>
						<option value="1">Images</option>
						<option value="1">Testimonials</option>
						</select>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
      </div>
          <div class="clearfix"></div>
        </div>
  </div>
    </section>
<div class="clearfix"></div>

    <section id="title">
     <div class="container margin-T30 margin-B10">
         <h3 class="revealOnScroll slow" data-animation="fadeInUpShort">Property results</h3>
        
        </div>
        </section>
<!-- testimonials Starts-->
<section id="search_page" >
  <div class="container">
   <div class="row">
     <div class="col-md-3 col-sm-6 margin-B20"> <a href="destination/courtyard_agra">
          <div class="hovereffect"> <img src="Images/Agra.jpg" alt="Courtyard Agra">
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"> <img src="Images/share.svg"> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20 liac">Courtyard Agra</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br>
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br>
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">189</span> <br>
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Agra</h2>
            </div>
          </div>
          </a> </div>
	 <div class="col-md-3 col-sm-6 margin-B20"> <a href="destination/courtyard_agra">
          <div class="hovereffect"> <img src="Images/Agra.jpg" alt="Courtyard Agra">
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"> <img src="Images/share.svg"> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20 liac">Courtyard Agra</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br>
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br>
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">189</span> <br>
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Agra</h2>
            </div>
          </div>
          </a> </div>
	 <div class="col-md-3 col-sm-6 margin-B20"> <a href="destination/courtyard_agra">

          <div class="hovereffect"> <img src="Images/Agra.jpg" alt="Courtyard Agra">
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"> <img src="Images/share.svg"> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20 liac">Courtyard Agra</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br>
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br>
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">189</span> <br>
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Agra</h2>
            </div>
          </div>
          </a> </div>
   <div class="col-md-3 col-sm-6 margin-B20"> <a href="destination/courtyard_agra">
          <div class="hovereffect"> <img src="Images/Agra.jpg" alt="Courtyard Agra">
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"> <img src="Images/share.svg"> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20 liac">Courtyard Agra</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br>
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br>
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">189</span> <br>
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Agra</h2>
            </div>
          </div>
          </a> </div>
   
   </div>
</section>

<div class="clearfix"></div>


		
 <section id="prop-desc">
   <div id="title">
     <div class="container margin-T10  margin-B10">
         <h3 class="  revealOnScroll slow" data-animation="fadeInUpShort">Property description results</h3>
                
        </div>
        </div>
  <div class="container">
  
<div class="well margin-B20">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="Images/Agra.jpg">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">Courtyard Agra</h4>
          
          <p>Courtyard Marriott Agra is ideal for a business trip or a relaxing getaway and is located minutes away from the Taj Mahal. Our spacious rooms & suites are among the largest in Agra & offer 5-star amenities. Meetings and events at the hotel are extraordinary; our expansive outdoor lawn provides a beautiful backdrop for outdoor weddings, our indoor venues are as versatile as they are elegant.</p>
          <ul class="list-inline list-unstyled">
  			<!--	<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li> -->
           
            <span><i class="glyphicon glyphicon-comment"></i> 2 Reviews</span>
            <li>|</li>
            <li>
               <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
            </li>
            <li>|</li>
            <li>
            <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
              <span><i class="fa fa-facebook-square"></i></span>
              <span><i class="fa fa-twitter-square"></i></span>
              <span><i class="fa fa-google-plus-square"></i></span>
            </li>
			</ul>
       </div>
    </div>
  </div>
  
  <div class="well margin-B20">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="Images/Agra.jpg">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">Courtyard Agra</h4>
          
          <p>Courtyard Marriott Agra is ideal for a business trip or a relaxing getaway and is located minutes away from the Taj Mahal. Our spacious rooms & suites are among the largest in Agra & offer 5-star amenities. Meetings and events at the hotel are extraordinary; our expansive outdoor lawn provides a beautiful backdrop for outdoor weddings, our indoor venues are as versatile as they are elegant.</p>
          <ul class="list-inline list-unstyled">
  		<!--	<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li> -->
           
            <span><i class="glyphicon glyphicon-comment"></i> 2 Reviews</span>
            <li>|</li>
            <li>
               <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
            </li>
            <li>|</li>
            <li>
            
              <span><i class="fa fa-facebook-square"></i></span>
              <span><i class="fa fa-twitter-square"></i></span>
              <span><i class="fa fa-google-plus-square"></i></span>
            </li>
			</ul>
       </div>
    </div>
  </div>
  
  <div class="well margin-B20">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="Images/Agra.jpg">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading">Courtyard Agra</h4>
          
          <p>Courtyard Marriott Agra is ideal for a business trip or a relaxing getaway and is located minutes away from the Taj Mahal. Our spacious rooms & suites are among the largest in Agra & offer 5-star amenities. Meetings and events at the hotel are extraordinary; our expansive outdoor lawn provides a beautiful backdrop for outdoor weddings, our indoor venues are as versatile as they are elegant.</p>
          <ul class="list-inline list-unstyled">
  				<!--	<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li> -->
            
            <span><i class="glyphicon glyphicon-comment"></i> 2 Reviews</span>
            <li>|</li>
            <li>
               <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
            </li>
            <li>|</li>
            <li>
            <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
              <span><i class="fa fa-facebook-square"></i></span>
              <span><i class="fa fa-twitter-square"></i></span>
              <span><i class="fa fa-google-plus-square"></i></span>
            </li>
			</ul>
       </div>
    </div>
  </div>
  </div>
  
</section>






<section id="prop-test">
  <div id="title">
     <div class="container margin-T10  margin-B10">
         <h3 class="  revealOnScroll slow" data-animation="fadeInUpShort">Property Testimonials results</h3>
                
        </div>
        </div>
  <div class="container">
  
 <div class="row">
  
  <div class="col-md-6">
  
  <div class="well margin-B20   ">
      <div class="media t_quotation">
      	 
  		<div class="media-body">
    		<h4 class="text-center media-heading">Unforgettable Service!</h4>
          
          <p class="text-center ">"I really appreciate the service and involvement of the staff in giving personal touch to make the event a memorable moment which we will cherish all the time."</p>
          <ul class="pull-right list-inline list-unstyled">
  			<!--	<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li> -->
           
            <span>- Roshan Kumar</span>
            
            
            
            
			</ul>
       </div>
    </div>
  </div>
  
  </div>
  <div class="col-md-6"> <div class="well  margin-B20 ">
      <div class="media t_quotation">
      
  		<div class="media-body">
    		<h4 class="media-heading text-center">Lively events, lively wedding</h4>
          
          <p class="text-center">"We are very very happy with how it turned out and our friends and our family had real fun at the events and also the ceremony. The events so made our big day!" </p>
          <ul class="list-inline pull-right list-unstyled">
  		<!--	<li><span><i class="glyphicon glyphicon-calendar"></i> 2 days, 8 hours </span></li> -->
           
            <span>- Sandeep Singh</span>
            
            
            
            
			</ul>
       </div>
    </div>
  </div></div>
  
  </div>
  
 
  
 
  </div>
  
</section>

<section id="prop-address">

  <div id="title">
   <div class="container margin-T10  margin-B10">
     <h3 class="  revealOnScroll slow" data-animation="fadeInUpShort">Property Address results</h3>
   </div>
  </div>
  
  <div class="container">
  <div class="row">
  <div class="col-md-3">
  <div class="well text-center margin-B20">
      <div class="media">
      	 
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
         <p class="adrs">Taj Nagri, Phase-2, Fatehabad Road,
              Agra - 282001, India</p>
			  <p class="padding-T10"><span><i class="icon-toll-free-small liac  "></i></span> +91-0562-2457777</p>
     
       </div>
    </div>
	</div>
  </div>
  
    <div class="col-md-3">
  <div class="well text-center margin-B20">
      <div class="media">
      	 
  		<div class="media-body">
    		<h4 class="media-heading liac">Four Points by Sheraton Ahmedabad</h4>
          
          <p class="adrs">Opp. Gujarat College, Ellis Bridge, Ahmedabad 380006. Gujarat, India,
Ahmedabad - 380006, 
India</p>
			  <p class="padding-T10"><span><i class="icon-toll-free-small liac  "></i></span> +91-91 79 49008888</p>
     
       </div>
    </div>
	</div>
  </div>
  
      <div class="col-md-3">
  <div class="well text-center margin-B20">
      <div class="media">
      	 
  		<div class="media-body">
    		<h4 class="media-heading liac">Four Points by Sheraton Ahmedabad</h4>
          
         <p class="adrs">Taj Nagri, Phase-2, Fatehabad Road,
              Agra - 282001, India</p>
			  <p class="padding-T10"><span><i class="icon-toll-free-small liac  "></i></span> +91-0562-2457777</p>
     
       </div>
    </div>
	</div>
  </div>
  
    <div class="col-md-3">
  <div class="well text-center margin-B20">
      <div class="media">
      	 
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
          <p class="adrs">Taj Nagri, Phase-2, Fatehabad Road,
              Agra - 282001, India</p>
			  <p class="padding-T10"><span><i class="icon-toll-free-small liac  "></i></span> +91-0562-2457777</p>
     
       </div>
    </div>
	</div>
  </div>
  
 
  </div>
  </div>
  

</section>


<section id="prop-gall">

  <div id="title">
   <div class="container margin-T10  margin-B10">
     <h3 class="  revealOnScroll slow" data-animation="fadeInUpShort">Property Images results</h3>
   </div>
  </div>
  
  <div class="container">
  <div class="row">
  <div class="col-md-3">
<div class="well text-center margin-B20">
      <div class="media">
      	 <img class="media-object margin-B20 img-responsive" src="Images/Agra.jpg" alt="placehold.it/350x250">
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
        
       </div>
    </div>
	</div>
  </div>
  
    <div class="col-md-3">
<div class="well text-center margin-B20">
      <div class="media">
      	 <img class="media-object margin-B20 img-responsive" src="Images/Agra.jpg" alt="placehold.it/350x250">
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
         
			  
     
       </div>
    </div>
	</div>
  </div>
  
      <div class="col-md-3">
<div class="well text-center margin-B20">
      <div class="media">
      	 <img class="media-object margin-B20 img-responsive" src="Images/Agra.jpg" alt="placehold.it/350x250">
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
         
			  
     
       </div>
    </div>
	</div>
  </div>
  
    <div class="col-md-3">
<div class="well text-center margin-B20">
      <div class="media">
      	 <img class="media-object margin-B20 img-responsive" src="Images/Agra.jpg" alt="placehold.it/350x250">
  		<div class="media-body">
    		<h4 class="media-heading liac">Courtyard Agra</h4>
          
         
			  
     
       </div>
    </div>
	</div>
  </div>
  
 
  </div>
  </div>
  

</section>




 
<!-- Footer -->
  
	<footer id="footer_full">&nbsp;</footer> 
	 <!-- // Footer -->

<script src="Scripts/plugin.js"></script>
 
</body>
</html>
