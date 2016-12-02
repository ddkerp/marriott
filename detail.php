<?php
require 'includes/master.inc.php';
$db  = Database::getDatabase();
$id = ISSET($_REQUEST["id"])?$_REQUEST["id"]:null;
if($id == null || !is_numeric($id)){
	echo "invalid request";exit;
}
$row = $db->getRow("SELECT * FROM venue WHERE status=1 AND id = " . $db->quote($id));
//printr($row);exit;
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title><link href="Images/favicon.png" rel="shortcut icon"><link href="CSS/style.css" rel="stylesheet" type="text/css" /><script src="Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
</head>

<body>
<div class="loader"></div>
<!-- Header -->
<header>
  <div class="container-fluid" id="banner">
    <div class="row">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active"> <img src="Images/Courtyard_Ahmedabad/Banner/Events-Alishan.jpg" alt="<?php echo $row['name'];?>">
            <div class="carousel-caption">
              <div class="pull-right col-sm-6 col-sm-12 text-right"> <a href="Javascript:;"><i class="icon-rating-medium icon-md"></i><span class="">4.5</span></a><a href="Javascript:;"> <i class="icon-share-medium icon-md bgliac"></i></a><a href="Javascript:;"> <i class="icon-start-planning-medium icon-md bgliac"></i></a><a href="http://www.marriott.com/hotels/travel/amdcy-courtyard-ahmedabad/" target="_blank"> <i class="icon-visit-website-medium icon-md bgliac"></i> </a></div>
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
<!-- About us Starts-->
<section id="aboutDestination" class="bgWhite">
  <div class="container">
    <div class="row margin-T50">
      <div class="col-md-7 col-xs-12">
        <h3 class="text-center margin-B30"><?php echo $row['name'];?></h3>
        <p class="text-center line-height-md"><?php echo $row['description'];?></p>
        <div class="clearfix"></div>
        <div class="row margin-T30 margin-B30 hotel_details">
          <div class="col-sm-4 col-xs-6 borderright1px">
            <div class="text-center">
              <p><i class="icon-total-capacity-xlarge icon-xl gainsboro"></i></p>
              <p class="facts">Largest Hall Capacity<br /><span> <?php echo $row['largest_hall_capacity'];?></span></p>
            </div>
          </div>
          <div class="col-sm-4 col-xs-6 borderright1px">
            <div class="text-center">
              <p><i class="icon-banquet-halls-xlarge icon-xl gainsboro"></i></p>
              <p class="facts">Banquet Halls<br /><span><?php echo $row['banquet_halls'];?> </span></p>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="text-center">
              <p><i class="icon-guest-rooms-xlarge icon-xl gainsboro"></i></p>
              <p class="facts"> Rooms<br /><span><?php echo $row['rooms'];?></span></p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row text-center">
          <p>
            <button type="button" class="btn btn-lg bgliac">View Brochure</button>
          </p>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-4 col-xs-12 pull-right Key_Amenities">
        <div class="row bgGrey-light padding20">
          <div class=" bgGrey-lighter padding10 border1px border-medium">
            <h3 class="text-center gainsboro">Key Amenities</h3>
            <div class="row margin-T20">
              <div class="col-sm-6 col-xs-6 text-center margin-TB10">
                <p><i class="icon-spa-xlarge icon-xl palesky"></i></p>
                <p class="title">Full-service Spa</p>
              </div>
              <div class="col-sm-6 col-xs-6 text-center margin-TB10">
                <p><i class="icon-pool-xlarge icon-xl palesky"></i></p>
                <p class="title">Pool</p>
              </div>
              <div class="col-sm-6 col-xs-6 text-center margin-TB10">
                <p><i class="icon-bar-xlarge icon-xl palesky"></i></p>
                <p class="title">Bar</p>
              </div>
              <div class="col-sm-6 col-xs-6 text-center margin-TB10">
                <p><i class="icon-laundry-xlarge icon-xl palesky"></i></p>
                <p class="title">Laundry</p>
              </div>
              <div class="col-sm-6 col-xs-6 text-center margin-TB10 hide">
                <p><i class=" icon-airport-shuttle-xlarge icon-xl palesky"></i></p>
                <p class="title">Airport shuttle</p>
              </div>
              <div class="col-sm-12 col-xs-12 text-center margin-TB10">
                <p><i class="icon-hr-room-service-xlarge icon-xl palesky"></i></p>
                <p class="title">24-hour room service</p>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</section>
<!-- About us Ends--> 

<!-- Enquiry Form Starts-->
<section id="enquiry" class="bgGrey-lighter2">
  <div class="container margin-T50 padding-B40 padding-T20" >
    <h3 class="text-center">Have a question? We'll call you back.</h3>
    <div class="row margin-T30">
      <form  name="contactus" id="registrationForm">
        <div class="col-sm-3 col-xs-12">
          <input name="name" type="text" class="inputbox input-xlarge" placeholder="Name" id="name"/>
        </div>
        <div class="col-sm-3 col-xs-12">
          <input name="email" type="email" class="inputbox input-xlarge" placeholder="Email" id="email"/>
        </div>
        <div class="col-sm-3 col-xs-12">
          <input name="mobile" type="text" class="inputbox input-xlarge" placeholder="Mobile" id="phone"/>
        </div>
        <div class="col-sm-3 col-xs-12">
          <button type="submit" class="btn btn-lg bgliac">Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Enquiry Form Ends--> 

<!-- Gallery Starts-->
<section id="gallerydestination"  class="bgWhite">
  <div class="container-fluid ">
    <div class="margin-B50 margin-T50">
      <h3 class="text-center">Gallery</h3>
      <p class="text-center">Plenty ideas & inspirations for your wedding</p>
    
      <!-- Insert to your webpage where you want to display the carousel -->
      <div id="amazingcarousel-container-1">
        <div id="amazingcarousel-1" style="display:none;position:relative;width:100%;max-width:1200px;margin:0px auto 0px;">
          <div class="amazingcarousel-list-container">
            <ul class="amazingcarousel-list">
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/CY-Ahmedabad-Facade.jpg" title="Façade
Located at the heart of Ahmedabad City Centre, only 30 minutes from Ahmedabad airport and Railway Station"  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/CY-Ahmedabad-Facade.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/CY-Ahmedabad-Facade.jpg"  alt="Façade
Located at the heart of Ahmedabad City Centre, only 30 minutes from Ahmedabad airport and Railway Station" /></a></div>
                </div>
              </li>
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/Events--Alishan.jpg" title="Events
Alishan, our exclusively designed ballroom for intimate weddings with an enormous pre-function area."  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/Events--Alishan.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/Events--Alishan.jpg"  alt="Events
Alishan, our exclusively designed ballroom for intimate weddings with an enormous pre-function area." /></a></div>
                </div>
              </li>
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--b&w.jpg" title="Our on-site retail liquor store boasts of 300+ labels of domestic and International spirits."  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--b&w.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--b&w.jpg"  alt="Facilities
1. b&w: Our on-site retail liquor store boasts of 300+ labels of domestic and International spirits." /></a></div>
                </div>
              </li>
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--Fitness-Centre.jpg" title="Fitness Centre: Stay fit and energized through the day with our 24X7 health club"  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--Fitness-Centre.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/Facilities--Fitness-Centre.jpg"  alt="Facilities 2. Fitness Centre: Stay fit and energized through the day with our 24X7 health club" /></a></div>
                </div>
              </li>
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/Food--Bayleaf.jpg" title="Food
Get spoilt for choice of sumptuous delicacies with MoMo Cafe, Bayleaf and Java+."  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/Food--Bayleaf.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/Food--Bayleaf.jpg"  alt="Food
Get spoilt for choice of sumptuous delicacies with MoMo Cafe, Bayleaf and Java+." /></a></div>
                </div>
              </li>
              <li class="amazingcarousel-item">
                <div class="amazingcarousel-item-container">
                  <div class="amazingcarousel-image"><a href="Images/Courtyard_Ahmedabad/Gallery Images/Room--Executive-Suite.jpg" title="Room
Settle in the comfort of our ergonomically designed rooms and suites with a range of amenities."  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="Images/Courtyard_Ahmedabad/Gallery Images/Room--Executive-Suite.jpg" ><img src="Images/Courtyard_Ahmedabad/Gallery Images/Room--Executive-Suite.jpg"  alt="Room
Settle in the comfort of our ergonomically designed rooms and suites with a range of amenities." /></a></div>
                </div>
              </li>
            </ul>
            <div class="amazingcarousel-prev"></div>
            <div class="amazingcarousel-next"></div>
          </div>
          <div class="amazingcarousel-nav"></div>
        </div>
      </div>
      <!-- End of body section HTML codes --> 
      
    </div>
  </div>
  <div class="clearfix"></div>
</section>
<!-- Gallery Ends-->

<section id="reviews" class="bgGrey-lighter2">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-xs-12 margin-T30 col-sm-push-1">
        <h3>Reviews</h3>
        <div class="review_testimonials">
          <div class="row margin-T30 testimonials">
            <div class="col-sm-2 col-xs-3"> <img src="Images/review1.png" class="img-rounded" alt="review" /> </div>
            <div class="col-sm-7 col-xs-9">
              <p><span>Admire N, Harare, Zimbabwe</span>"This a very comfortable hotel with good ambience, its clean and beautiful. The bed comfort is very good, friendly and excellent staff from housekeeping to restaurants who are concerned about your welfare and comfort. Suitable for both business and holiday.access to wifi, fitness centre, spa and swimming pool." </p>
            </div>
            <div class="col-sm-3 col-xs-12 review_rate"> <i class=" icon-rate-us-medium icon-md liac"></i> <span> 4.0</span> </div>
          </div>
          <div class="row margin-T30 testimonials">
            <div class="col-sm-2 col-xs-3"> <img src="Images/review2.png" class="img-rounded" alt="review" /> </div>
            <div class="col-sm-7 col-xs-9">
              <p><span> Tushar G, Pune, India</span>If it is Marriott I need not say anything the name says it all 
                Excellent Business hotel with outstanding services and very courteous and professional staff 
                Food is super delicious be it Momo's cafe, Java+ or bay leaf really relished all the meals 
                b&w is again a place to see such niche collection of liquor from around the globe brands
                Rooms are extremely comfortable with all the modern facilities. Hats off to the management for maintaining the property so well. </p>
            </div>
            <div class="col-sm-3 col-xs-12 review_rate"> <i class="icon-rate-us-medium icon-md liac"></i> <span> 5.0</span> </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class=" text-right margin-T30 width-90per"> <a href="javascript:;" id="reviews_testimonials_more" title="Read more">Read more</a>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="row margin-T30 review_form">
          <div class="pull-left col-sm-8">
            <h5>Submit a review</h5>
          </div>
          <div class="col-sm-3">
            <p class="text-right text-uppercase">Rate us <span><i class="icon-rate-us-medium icon-sm"></i></span></p>
          </div>
          <div class="clearfix"></div>
          <form  name="contactus" id="reviewForm" class="width-90per">
            <div class="col-sm-4 col-xs-12">
              <input name="name" type="text" class="inputbox input-xlarge" placeholder="Name" id="name"/>
            </div>
            <div class="col-sm-4 col-xs-12">
              <input name="email" type="email" class="inputbox input-xlarge" placeholder="Email" id="email"/>
            </div>
            <div class="col-sm-4 col-xs-12">
              <input name="mobile" type="text" class="inputbox input-xlarge" placeholder="Mobile" id="phone"/>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12 margin-T10">
              <textarea class="form-control review_text"  name="reviewmessage"  id="reviewsmsg" rows="4" >Share your experience with us...</textarea>
            </div>
            <div class="clearfix"></div>
            <div class=" review_submit col-sm-12">
              <button type="submit" class="btn btn-lg pull-right margin-T20">Submit</button>
            </div>
          </form>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="col-sm-5 col-xs-12 contact pull-right">
        <div class="text-center margin-T100 margin-B150 bgGrey2 col-md-6">
          <div class="row contactborder">
            <h4><?php echo $row['name'];?> <br />
              <span><?php echo $row['city'];?></span></h4>
            <p class="padding-T10"><?php echo $row['address'];?>,<br />
              <?php echo $row['city'];?> - <?php echo $row['pincode'];?>, <br>
              <?php echo $row['country'];?> </p>
            <p class="padding-T10"><span><i class="icon-toll-free-small liac icon-md"></i></span> +91-<?php echo $row['phone'];?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>

<!-- Footer -->
   
	<footer id="footer_full">&nbsp;</footer> 
	<!-- // Footer -->

<script src="Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>-->
<script src="Scripts/validation.js"></script> 
<script src="carouselengine/amazingcarousel.js"></script> 
<script src="carouselengine/initcarousel-1.js"></script> 
<script>
	 $(document).ready(function() { 
	//validation	
	 jQuery('#registrationForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            container: 'tooltip'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your name'
                    },
					 regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'The full name can only consist of alphabetical and spaces'
                    }
                }
            },
			email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your mobile number'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The mobile number can only consist of numbers'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
		 e.preventDefault();
 var hotelname = 'Courtyard Ahmedabad';
		 	var formData = {
			'first_name' 			: $('input[name=name]').val(),
			'email_address' 		: $('input[name=email]').val(),
			'HotelName' 			: hotelname,
			'mobile_number' 		: $('input[name=mobile]').val()			
		};
// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'https://resu.io/Subscription/Index/Y3VzdF8zN2NjMGJkOV85YjdjXzQxNWVfOWE1OV80NDQ5MjIzMjE0ZmU=/1', // the url where we want to POST
			data 		: formData
			
		})
			// using the done promise callback
			.done(function(data) {
				console.log(data); 
				 window.location = "thankyou.html";
			})
			// using the fail promise callback
			.fail(function(data) {
				console.log(data);
				 window.location = "thankyou.html";
			});
	});
//validation	
	 jQuery('#reviewForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            container: 'tooltip'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your name'
                    },
					 regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'The full name can only consist of alphabetical and spaces'
                    }
                }
            },
			email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your mobile number'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The mobile number can only consist of numbers'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
		 e.preventDefault();
		  var hotelname_review = 'Courtyard Ahmedabad';
		 	var formData = {
			'first_name' 			: $('input[name=name]').val(),
			'email_address' 		: $('input[name=email]').val(),
			'HotelName' 			: hotelname_review,
			'mobile_number' 		: $('input[name=mobile]').val()
			
		};
// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'https://resu.io/Subscription/Index/Y3VzdF8zN2NjMGJkOV85YjdjXzQxNWVfOWE1OV80NDQ5MjIzMjE0ZmU=/1', // the url where we want to POST
			data 		: formData
			
		})
			// using the done promise callback
			.done(function(data) {
				console.log(data); 
				 window.location = "thankyou.html";
			})
			// using the fail promise callback
			.fail(function(data) {
				console.log(data);
				 window.location = "thankyou.html";
			});
	});
    });
</script>
    <!-- Tracking Code -->
<script src='https://static.getclicky.com/js'></script><script>try {clicky.init(100849934);} catch (e) {}</script><noscript><img height='1' width='1' src='http://static.getclicky.com/100849934ns.gif' /></noscript>
<script type='text/javascript' langauge='javascript'>document.write(unescape("%3Cscript src='" + "Scripts/sslpathanalyzer.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type='text/javascript' langauge='javascript'>fnTrackUrl('51620749-5585-420a-baf3-097a1bf718ac');</script>
    <!-- Tracking Code -->
</body>
</html>