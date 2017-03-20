<?php
require_once("includes.php");
$db  = Database::getDatabase();
$id = ISSET($_REQUEST["id"])?$_REQUEST["id"]:null;
$name = strtolower(str_replace(' ','_',$id));
$row = $db->getRow("SELECT * FROM venue WHERE status=1 AND REPLACE(LOWER(name),' ','_') = " . $db->quote($name));
$id = $row['id'];
if($id==null){
	exit("no venue");
}
/*
if($id == null || !is_numeric($id)){
	echo "invalid request";exit;
}
$row = $db->getRow("SELECT * FROM venue WHERE status=1 AND id = " . $db->quote($id));
*/
$row = $db->getRow("SELECT * FROM venue WHERE status=1 AND id = " . $db->quote($id));
$images = $db->getRows("SELECT * FROM venue_image WHERE status=1 AND venue_id = " . $db->quote($id) ."");

$amenities = $db->getRows("SELECT a.* FROM venue_amenity va JOIN amenity a on(a.id=va.amenity_id) WHERE a.status=1 AND va.venue_id = " . $db->quote($id) ."");

$reviews = $db->getRows("SELECT * FROM review WHERE status=1 AND venue_id = " . $db->quote($id) ."");
		  

//printr($reviews);exit;
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title><link href="<?php echo BASEURL;?>/Images/favicon.png" rel="shortcut icon"><link href="<?php echo BASEURL;?>/CSS/style.css" rel="stylesheet" type="text/css" /><link href="<?php echo BASEURL;?>/CSS/star-rating.css" rel="stylesheet" type="text/css" /><script src="<?php echo BASEURL;?>/Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
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
          <div class="item active"> <img src="<?php echo BASEURL;?>/Images/<?php echo $row['banner_image'];?>" alt="<?php echo $row['name'];?>">
            <div class="carousel-caption">
              <div class="pull-right col-sm-6 col-sm-12 text-right"> <a href="Javascript:;"><i class="icon-rating-medium icon-md"></i><span class=""><?php echo $row['overall_rating'];?></span></a><a href="Javascript:;"> <i class="icon-share-medium icon-md bgliac"></i></a><a href="Javascript:;"> <i class="icon-start-planning-medium icon-md bgliac"></i></a><a href="<?php echo $row['vanity_url'];?>" target="_blank"> <i class="icon-visit-website-medium icon-md bgliac"></i> </a></div>
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
        <h3 class="text-center margin-B30 revealOnScroll" data-animation="fadeInUp"><?php echo $row['name'];?></h3>
        <p class="text-center line-height-md revealOnScroll slow delay-100" data-animation="fadeInUp"><?php echo $row['description'];?></p>
        <div class="clearfix"></div>
        <div class="row margin-T30 margin-B30 hotel_details revealOnScroll slow" data-animation="fadeInUpShort">
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
        <div class="row text-center revealOnScroll slow" data-animation="fadeInUpShort">
          <p>
            <button type="button" class="btn btn-lg bgliac">View Brochure</button>
          </p>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="col-md-4 col-xs-12 pull-right Key_Amenities">
        <div class="row bgGrey-light padding20">
          <div class=" bgGrey-lighter padding10 border1px border-medium">
            <h3 class="text-center gainsboro revealOnScroll slow" data-animation="fadeInUp">Key Amenities</h3>
            <div class="row margin-T20">
			<?php 
			$i=1;
			foreach($amenities as $amenity){
				$col = "col-sm-6 col-xs-6";
				if($i == count($amenities) && $i%2!=0){
					$col = "col-sm-12 col-xs-12";
				}
				$i++;
					?>
				<div class="<?php echo $col;?> text-center margin-TB10 revealOnScroll slow delay-100" data-animation="fadeInUpShort">
                <p><i class="<?php echo $amenity['class'];?> icon-xl palesky"></i></p>
                <p class="title"><?php echo $amenity['name'];?></p>
              </div>
			<?php }?>
             
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
    <h3 class="text-center revealOnScroll slow" data-animation="fadeInUp">Have a question? We'll call you back.</h3>
    <div class="row margin-T30 revealOnScroll slow delay-100" data-animation="fadeInUpShort">
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
      <h3 class="text-center revealOnScroll slow" data-animation="fadeInUp">Gallery</h3>
      <p class="text-center revealOnScroll slow delay-100" data-animation="fadeInUp">Plenty ideas & inspirations for your wedding</p>
    
      <!-- Insert to your webpage where you want to display the carousel -->
      <div id="amazingcarousel-container-1" class=" revealOnScroll slow delay-100" data-animation="fadeInUp">
        <div id="amazingcarousel-1" style="display:none;position:relative;width:100%;max-width:1200px;margin:0px auto 0px;">
          <div class="amazingcarousel-list-container">
            <ul class="amazingcarousel-list">
				<?php
				foreach($images as $image){
					?>
					 <li class="amazingcarousel-item">
								<div class="amazingcarousel-item-container">
								  <div class="amazingcarousel-image"><a href="<?php echo BASEURL;?>/Images/<?php echo $image['file_name']; ?>" title="<?php echo $image['title']; ?>"  class="html5lightbox" data-group="amazingcarousel-1" data-thumbnail="<?php echo BASEURL;?>/Images/<?php echo $image['file_name']; ?>" ><img src="<?php echo BASEURL;?>/Images/<?php echo $image['file_name']; ?>"  alt="<?php echo $image['title']; ?>" /></a></div>
								</div>
							  </li>
				<?php
				}	?>
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
        <h3 class="revealOnScroll slow" data-animation="fadeInUp">Reviews</h3>
        <div class="review_testimonials revealOnScroll slow" data-animation="fadeInUp">
		<?php foreach($reviews as $review){?>
          <div class="row margin-T30 testimonials">
            <div class="col-sm-2 col-xs-3 hide"> <img src="<?php echo BASEURL;?>/Images/review1.png" class="img-rounded" alt="review" /> </div>
            <div class="col-sm-9 col-xs-9">
              <p><span><?php echo $review['user_name'];?></span><span><strong><?php echo $review['review_subject'];?></strong></span>"<?php echo $review['review_text'];?>" </p>
            </div>
			<?php
			$rating_arr = explode(",",$review['ratings']);
			$rating_avg = number_format(round(array_sum($rating_arr)/count($rating_arr),1),1);
			?>
            <div class="col-sm-3 col-xs-3 review_rate"> <i class=" icon-rate-us-medium icon-md liac"></i> <span> <?php echo $rating_avg;?></span> </div>
          </div>
		<?php }?>
          <div class="clearfix"></div>
        </div>
        <div class=" text-right margin-T30 width-90per revealOnScroll slow delay-100" data-animation="fadeInUpShort"> <a href="javascript:;" id="reviews_testimonials_more" title="Read more">Read more</a>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="row margin-T30 review_form">
          <div class="pull-left col-sm-8">
            <h5 class="revealOnScroll slow" data-animation="fadeInUpShort">Submit a review</h5>
          </div>
          <div class="col-sm-3 revealOnScroll slow" data-animation="fadeInUpShort">
                            <a href="#" data-toggle="modal" data-target="#reviewModal" class="no-hover pull-right">
            <p class="text-right text-uppercase">Rate us <span><i class="icon-rate-us-medium icon-sm"></i></span></p>
                            </a>
          </div>
          <div class="clearfix"></div>
          <form  name="contactus" id="reviewForm" class="width-90per revealOnScroll slow delay-100" data-animation="fadeInUpShort">
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
			<div class="col-sm-12 margin-T10 col-xs-12">
              <input name="reviewsubject" type="text" class="inputbox input-xlarge" placeholder="Subject" id="reviewsubject"/>
            </div>
            <div class="col-sm-12 margin-T10">
              <textarea class="form-control review_text"  name="reviewmessage"  placeholder="Share your experience with us..." id="reviewsmsg" rows="4" ></textarea>
            </div>
            <div class="clearfix"></div>
            <div class=" review_submit col-sm-12">
              <button type="submit" class="btn btn-lg pull-right margin-T20">Submit</button>
            </div>
          </form>
          <div class="clearfix"></div>
                        <!-- Modal -->
		  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="reviewModal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body text-center">
						<h5 class="text-center">Rate Us</h5>
						<div class="clearfix"></div>
						<div class="col-sm-3">
							<div class="row">
								<p>Service</p>
							<input type="text" id="rateService" class="kv-gly-heart rating-loading" value="1" data-size="xs" title="">
						</div></div>
						<div class="col-sm-3">
							<div class="row">
								<p>Food</p>
							<input type="text" id="rateFood" class="kv-gly-heart rating-loading" value="2.5" data-size="xs" title="">
						</div></div>
						<div class="col-sm-3">
							<div class="row">
								<p>Decor</p>
							<input type="text" id="rateDecor" class="kv-gly-heart rating-loading" value="1.75" data-size="xs" title="">
						</div></div>
						<div class="col-sm-3">
							<div class="row">
								<p>Events</p>
							<input type="text" id="rateEvents" class="kv-gly-heart rating-loading" value="4" data-size="xs" title="">
						</div></div>
						<div class="clearfix"></div>
						<div class="col-sm-12 margin-T20 hide">
				<textarea class="form-control review_text" name="reviewmessage" id="reviewsmsg" placeholder="Share your experience with us..." rows="4"></textarea>
			</div>
			<div class="clearfix"></div>
						<button type="button" id="rateButton" class="btn margin-T20">Submit</button>
					</div>
				</div>
			</div>
		</div> 
        </div>
      </div>
      <div class="col-sm-5 col-xs-12 contact pull-right">
        <div class="text-center margin-T100 margin-B150 bgGrey2 col-md-6">
          <div class="row contactborder revealOnScroll slow" data-animation="fadeInUpShort">
            <h4><?php echo $row['name'];?> <br />
              <span><?php //echo $row['city'];?></span></h4>
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

<script src="<?php echo BASEURL;?>/Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>-->
<script src="<?php echo BASEURL;?>/Scripts/validation.js"></script> 
<script src="<?php echo BASEURL;?>/carouselengine/amazingcarousel.js"></script> 
<script src="<?php echo BASEURL;?>/carouselengine/initcarousel-1.js"></script> 
<script src="<?php echo BASEURL;?>/Scripts/star-rating.min.js" type="text/javascript"></script>

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
				var hotelname = '<?php echo $row['name'];?>';
				var formData = {
				'first_name' 			: $(this).find('input[name=name]').val(),
				'email_address' 		: $(this).find('input[name=email]').val(),
				'HotelName' 			: hotelname,
				'mobile_number' 		: $(this).find('input[name=mobile]').val()			
			};
	// process the form
			$.ajax({
				type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url 		: 'https://resu.io/Subscription/Index/Y3VzdF8zN2NjMGJkOV85YjdjXzQxNWVfOWE1OV80NDQ5MjIzMjE0ZmU=/1', // the url where we want to POST
				data 		: formData
				
			})
			var formData = {
				'first_name' 			: $(this).find('input[name=name]').val(),
				'email_address' 		: $(this).find('input[name=email]').val(),
				'venueid' 				: '<?php echo $row['id'];?>',
				'page' 					: '<?php echo $row['name'];?>',
				'mobile_number' 		: $(this).find('input[name=mobile]').val()
				
			};
			$.ajax({
				type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url 		: '<?php echo BASEURL;?>/api/save_enquiry.php', // the url where we want to POST
				data 		: formData
				
			})
				// using the done promise callback
				.done(function(data) {
					console.log(data); 
					 window.location = "<?php echo BASEURL;?>/thankyou.html";
				})
				// using the fail promise callback
				.fail(function(data) {
					console.log(data);
					 window.location = "<?php echo BASEURL;?>/thankyou.html";
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
			  var hotelname_review = '<?php echo $row['name'];?>';
				var formData = {
				'first_name' 			: $(this).find('input[name=name]').val(),
				'email_address' 		: $(this).find('input[name=email]').val(),
				'HotelName' 			: hotelname_review,
				'mobile_number' 		: $(this).find('input[name=mobile]').val()
				
			};
	// process the form
			$.ajax({
				type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url 		: 'https://resu.io/Subscription/Index/Y3VzdF8zN2NjMGJkOV85YjdjXzQxNWVfOWE1OV80NDQ5MjIzMjE0ZmU=/1', // the url where we want to POST
				data 		: formData
				
			})
			var formData = {
				'first_name' 			: $(this).find('input[name=name]').val(),
				'email_address' 		: $(this).find('input[name=email]').val(),
				'venueid' 				: '<?php echo $row['id'];?>',
				'reviewsubject' 		: $(this).find('input[name=reviewsubject]').val(),
				'reviewmessage' 		: $(this).find('textarea[name=reviewmessage]').val(),
				'mobile_number' 		: $(this).find('input[name=mobile]').val(),
				'rating'				: $('#rateService').val()+','+$('#rateFood').val()+','+$('#rateDecor').val()+','+$('#rateEvents').val()
				
			};
			$.ajax({
				type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
				url 		: '<?php echo BASEURL;?>/api/save_review.php', // the url where we want to POST
				data 		: formData
				
			})
				// using the done promise callback
				.done(function(data) {
					console.log(data); 
					 window.location = "<?php echo BASEURL;?>/thankyou.html";
				})
				// using the fail promise callback
				.fail(function(data) {
					console.log(data);
					 window.location = "<?php echo BASEURL;?>/thankyou.html";
				});
		});
		// review ratings heart
		$('.kv-gly-heart').rating({
			containerClass: 'is-heart',
		   // defaultCaption: '{rating} hearts',
			starCaptions: function (rating) {
				return rating == 1 ? '1.0' : rating;
			},
			filledStar: '<i class="icon-rating-medium liac icon-md"></i>',
			emptyStar: '<i class="icon-rate-us-medium icon-md"></i>'
			 //filledStar: '<i class="glyphicon glyphicon-heart"></i>',
			//emptyStar: '<i class="glyphicon glyphicon-heart-empty"></i>'
		});
		$('.rating,.kv-gly-heart').on(
			'change',
			function () {
				console.log('Rating selected: ' + $(this).val());
		 });
		 $('#rateButton').on('click',function (){
			  $('#reviewModal').modal('hide');
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