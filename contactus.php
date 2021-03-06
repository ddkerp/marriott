<?php
require_once("includes.php");
$db = Database::getDatabase();
$rows = $db->getRows("SELECT * FROM venue");
$venue_sel_opt="";
foreach($rows as $row){
	$venue_sel_opt = $venue_sel_opt."<option value='".$row['id']."'>".$row['name']."</option>\n";
}		
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriott - the one-stop solution for dream destination weddings. Weddings at Marriott mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriott, India</title><link href="Images/favicon.png" rel="shortcut icon"><link href="CSS/style.css" rel="stylesheet" type="text/css" /><script src="Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
</head>

 <body>
<div class="loader"></div>
<!-- Header -->
<header id="contact">
   <div class="container-fluid" id="banner">
    <div class="row">
       <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
           <div class="item t_banner active "> <img src="Images/contact_banner.jpg" alt="..." > </div>
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
<!-- contact Starts-->
<section id="contact_page" class="bgWhite">
   <div class="container">
    <div class="row margin-T20 margin-B20">
       <h3 class="text-center revealOnScroll slow delay-250" data-animation="fadeInUpShort">Get in touch</h3>
       <p class="text-center revealOnScroll slow delay-500" data-animation="fadeInUpShort">Wish to host your wedding at Marriott? No worries, just get in touch with us.</p>
       <p class="text-center revealOnScroll slow delay-500" data-animation="fadeInUpShort"> <i class="icon-decor-glyph-medium liac icon-lg"></i></p>
     </div>
    <div class="clearfix"></div>
    <form  name="contactus" id="registrationForm" method="POST" action="thankyou.php">
       <div class="row margin-B10 revealOnScroll slow delay-750" data-animation="fadeInUpShort">
        <div class="col-sm-9">
           <div class="row  margin-B10">
            <div class="col-sm-6 col-xs-12">
               <select class="input-xlarge" id="venue" name="venue">
                <option value="">Venue</option>
                <?php echo $venue_sel_opt;?>
              </select>
             </div>
            <div class="col-sm-6 col-xs-12">
               <input name="f_name" type="text" class="inputbox input-xlarge" placeholder="Full name" id="f_name"/>
             </div>
          </div>
           <div class="clearfix"></div>
           <div class="row margin-B10">
            <div class="col-sm-2 col-xs-3 inputTel">
               <input name="tel" type="tel" class="inputbox input-xlarge" placeholder="91" id="tel"/>
             </div>
            <div class="col-sm-4 col-xs-9 inputTelNo">
               <input name="phone" type="text" class="inputbox input-xlarge" placeholder="Phone" id="phone"/>
             </div>
            <div class="col-sm-6 col-xs-12">
               <input name="email" type="email" class="inputbox input-xlarge" placeholder="Email" id="email"/>
             </div>
          </div>
           <div class="clearfix"></div>
         </div>
        <div class="col-sm-3">
           <textarea class="form-control review_text" name="textmsg" id="textmsg" rows="4" >Message</textarea>
         </div>
      </div>
       <div class="clearfix"></div>
       <div class="row margin-B10 revealOnScroll slow delay-1000" data-animation="fadeInUpShort">
        <div class="col-sm-12">
           <p>By submitting this form, I agree to the following:
            <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox">
            <label for="checkbox-1" class="checkbox-custom-label">Terms of use</label>
            <input id="checkbox-2" class="checkbox-custom" name="checkbox-2" type="checkbox" checked>
            <label for="checkbox-2" class="checkbox-custom-label"><a href="http://www.marriott.com/about/privacy.mi" target="_blank">Privacy statement</a></label>
            <input id="checkbox-3" class="checkbox-custom" name="checkbox-3" type="checkbox" checked="checked">
            <label for="checkbox-3" class="checkbox-custom-label">Subscribe to Newsletter</label>
          </p>
         </div>
      </div>
       <div class="clearfix"></div>
       <div class="row margin-B50 pull-right revealOnScroll slow delay-250" data-animation="fadeInUpShort">
        <div class="col-sm-12">
           <input name="reset" id="resetButton" type="reset" value="Clear" class="c_clear" />
           <button type="submit" class="btn btn-lg">Submit</button>
         </div>
      </div>
       <div class="clearfix"></div>
     </form>
  </div>
 </section>
<div class="clearfix"></div>
<!-- contact Form End -->
<section id="c_mapAddress">
   <div class="container" >
    <div class="row margin-B100">
       <div class="col-md-6 col-xs-12 h_content revealOnScroll slow" data-animation="fadeInUpShort">
        <div class="row padding20">
           <div class="borderatomic ">
            <div class="col-xs-12">
               <h3 class="text-left margin-B10 padding-T10">Have a dream destination <br />
                in mind for your wedding?<br />
                <span class="padding-T20"> We'll help you find it.</span> </h3>
               <hr />
               <div class="clearfix"></div>
               <p class="line-height-md margin-B10"> <span> <i class="icon-mail-medium icon-md white"></i></span> <span class="connect">CONNECT WITH US AT<br />
                 <span class="mail"> <a href="mailto:contact@marriottindiaweddings.com"><strong>contact</strong><em>@marriottindiaweddings.com</em></a></span></span></p>
               <p class="line-height-md margin-B10 visibility-hidden"><i class="icon-call-medium liac"></i> +91-22-67241082<br />
                <span>Monday to Friday, 9am – 6pm</span></p>
               <p class="line-height-md margin-B20  visibility-hidden"><i class="icon-mobile-medium liac"></i> +91 9167089120<br />
                <span>Monday to Sunday, 9am – 6pm</span></p>
               <div class="clearfix"></div>
             </div>
            <div class="clearfix"></div>
          </div>
         </div>
        <div class="clearfix"></div>
      </div>
       <div class="map col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xxs-12 row revealOnScroll slow" data-animation="fadeInUpShort" id="map_canvas"></div>
       <div class="col-md-6 col-xs-12 map hide"  >
        <div class="row revealOnScroll slow" data-animation="fadeInUpShort"> <img src="Images/c_map.jpg" class="img-responsive width-100per minheight" alt="JWMarriott" /> </div>
        <div class="clearfix"></div>
      </div>
       <div class="clearfix"></div>
     </div>
  </div>
   <div class="clearfix"></div>
 </section>

<!-- Contact Address End -->
<section id="c_newsletter">
   <div class="container" >
    <div class="row margin-B50 revealOnScroll slow" data-animation="fadeInUpShort">
       <div class="col-xs-12">
        <h3 class="text-center">Subscribe to our Newsletter</h3>
        <p class="text-center margin-B30">Enter your email address below to receive occasional updates.</p>
        <div class="clearfix"></div>
        <form  name="subscription" id="subscriptionForm">
           <div class="col-sm-9 col-xs-12">
            <input name="email" type="email" class="inputbox input-xlarge" placeholder="Email" id="email" />
          </div>
           <div class="col-sm-3 col-xs-12 row">
            <button type="submit" class="btn btn-lg bgliac">Submit</button>
          </div>
           <div class="clearfix"></div>
         </form>
      </div>
     </div>
  </div>
   <div class="clearfix"></div>
 </section>
<div class="clearfix"></div>
<!-- Footer -->
<footer id="footer_full">&nbsp;</footer>
<!-- // Footer --> 

<script src="Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>--> 
<script src="Scripts/validation.js"></script> 
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
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
        fields: {
            f_name: {
                row: '.col-xs-12',
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
            phone: {
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
            tel: {
                  validators: {
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Please enter the country code'
                    },
                    stringLength: {
                        min: 2,
						max:2,
                        message: 'Country code should be 2 numbers only'
                    }
				  }
            },
            textmsg: {
                validators: {
                    notEmpty: {
                        message: 'Your Message is required'
                    },
                    stringLength: {
                        min: 10,
                        message: 'Your message must be at least 10 characters long'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
		 e.preventDefault();		  
		  var mob = $("#tel").val() + '' +  $("#phone").val();		 	
		 	var formData = {
			'first_name' 			: $('input[name=f_name]').val(),
			'email_address' 		: $('input[name=email]').val(),
			'HotelName' 			: $("#venue option:selected").text(),
			'mobile_number' 		: mob
			
		};
// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'https://resu.io/Subscription/Index/Y3VzdF8zN2NjMGJkOV85YjdjXzQxNWVfOWE1OV80NDQ5MjIzMjE0ZmU=/1', // the url where we want to POST
			data 		: formData
			
		});
		var formData = {
			'venue' 			: $("#registrationForm #venue").val(),
			'f_name' 			: $("#registrationForm #f_name").val(),
			'tel' 				: $("#registrationForm #tel").val(),
			'phone' 			: $("#registrationForm #phone").val(),
			'email' 			: $("#registrationForm #email").val(),
			'textmsg' 			: $("#registrationForm #f_name").val(),
			'checkbox-2' 		: $("#checkbox-2").prop("checked"),
			'checkbox-3' 		: $("#checkbox-3").prop("checked")
			
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'api/save_contactus.php', // the url where we want to POST
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
	 jQuery('#resetButton').on('click', function(e) {
        var fields = $('#registrationForm').data('formValidation').getOptions().fields,
            $parent, $icon;
        for (var field in fields) {
            $parent = $('[name="' + field + '"]').parents('.form-group');
            $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + field + '"]');
            $icon.tooltip('destroy');
        }
        // Then reset the form
        $('#registrationForm').data('formValidation').resetForm(true);
    });

// Subscription Form
 jQuery('#subscriptionForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        err: {
            // You can set it to popover
            // The message then will be shown in Bootstrap popover
            container: 'tooltip'
        },
		 fields: {
			 email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            }
			}
    }).on('success.form.fv', function(e) {
		 e.preventDefault();
		 
		 var formData = {
			'email' 		: $(this).find('input[name=email]').val()
		};
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'api/save_newsletter.php', // the url where we want to POST
			data 		: formData
			
		})
		// using the done promise callback
			.done(function(data) {
				console.log(data); 
				  window.location = "thankyou_subscription.html";
			})
			// using the fail promise callback
			.fail(function(data) {
				console.log(data);
				 window.location = "thankyou_subscription.html";
			});

	});
});
</script> 
<script>
	var myMap = [ 
		['<b>JW Marriott Pune</b><br>Senapati Bapat Road, <br>Pune, <br>Maharashtra 411053<br>India.<br><br><b>Ph: +91-20-66833333</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '18.532637', '73.829794', 'destination_Pune.html'],
		['<b>Kochi Marriott Hotel </b><br>Lulu International Shopping Mall Pvt. Ltd.,<br> 34/1111, N. H. 47,<br> Edapally, Kochi- 682024<br>India.<br><br><b>Ph: +91-484-7177777</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '10.029102', '76.308229', 'destination_Kochi.html'],
		['<b>Courtyard Ahmedabad</b><br>Ramdev Nagar Cross Road, <br>Satellite Road,<br>  Ahmedabad  380015<br>India.<br><br><b>Ph: +917966185000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '23.027878', '72.512193', 'destination_Ahmedabad.html'],
		['<b>JW Marriott Sahar</b><br> IA Project Road, <br>Chhatrapati Shivaji International Airport,<br>  Andheri Mumbai, 400099,<br>India.<br><br><b>Ph: +91-22 2853 8888</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>','19.103082', '72.877553', 'destination_SaharMumbai.html'],
		['<b>Renaissance Mumbai</b><br>2&3B,<br> Near Chinmayanand Ashram,<br> Powai,<br> Mumbai - 400087<br>India.<br><br><b>Ph: +91- 22 6692 7777</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '19.134321', '72.901327', 'destination_RenaissanceMumbai.html'],
		['<b>Goa Marriott Resort</b><br>PO Box No. 64,<br>Miramar,<br> Panaji,<br> Goa - 403001<br>India.<br><br><b>Ph: +91-832- 665 6044 </b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '15.486767', '73.809357', 'destination_Goa.html'],
		['<b>Courtyard Marriott Bhopal</b><br>DB City, Arera Hills,<br >Bhopal 462011, <br>Madhya Pradesh, India<br><br><b>Ph: +91-755 3096444 </b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b> ', '23.233042', '77.429392', 'destination_Courtyard_Marriott_Bhopal.html'],
		['<b>Courtyard Agra</b><br>Taj Nagri, <br>Phase-2,Fatehabad Road,<br >Agra - 282001, <br>India<br><br><b>Ph: +91-562-2457777 </b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b> ', '27.156074', '78.059918', 'destination_Courtyard_Agra.html'],
		['<b>JW Marriott Mumbai Juhu</b><br>Juhu Tara Road,<br>Mumbai - 400049, <br>India<br><br><b>Ph: +91-22-66933000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b> ', '19.101443', '72.825775', 'destination_JW-Marriott-Mumbai-Juhu.html'],
		['<b>Courtyard Chennai</b><br>564, Anna Salai,<br>Teynampet,<br>Chennai - 600018, <br>India<br><br><b>Ph: +91-44-66764000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b> ', '13.052355', '80.251950', 'destination_Courtyard-Chennai.html'],
		['<b>Marriott Suites Pune</b><br>81, Mundhwa Koregaon Park,<br>Annex Pune-411036,<br>Maharashtra <br>India<br><br><b>Ph: +91-20-6725-77-77</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '18.533449', '73.910657', 'destination_Marriott-Suites-Pune.html'],
		['<b>Jaipur Marriott Hotel</b><br>Ashram marg,<br>Near Jawahar Circle,<br>Jaipur 302015, <br>Rajasthan, India<br><br><b>Ph: +91-141-4567777</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '26.842094', '75.796405', 'destination_Jaipur-Marriott-Hotel.html'],
		['<b>JW Marriott New Delhi Aerocity</b><br>Asset Area - 4,<br>Hospitality District,<br>Near Indira Gandhi Airport,<br>Delhi Aerocity - New Delhi. 110037  <br>India<br><br><b>Ph: +91-11-4521-2121</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '28.552555', '77.121233', 'destination_JW-Marriott-New-Delhi-Aerocity.html'],		 
		['<b>JW Marriott Chandigarh</b><br>Plot no: 6, Sector 35-B,<br>Dakshin Marg,<br>Chandigarh 1600 35<br>India<br><br><b>Ph: +91-172-395-5555</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '30.726669', '76.767190', 'destination_JW-Marriott-Chandigarh.html'],
		['<b>Courtyard Raipur</b><br>Opp. Indira Gandhi Agriculture University,<br>NH 6, Labhandi,<br>Raipur 492012, <br>Chhattisgarh ,India<br><br><b>Ph: +91-771-4330000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '21.238288', '81.701436', 'destination_Courtyard-Raipur.html'],
		['<b>Courtyard Bilaspur</b><br>Citymall 36,<br>Mangla Chowk, <br>Bilaspur- 495001, <br>Chhattisgarh ,India<br><br><b>Ph: +91-7752-432222</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '22.094409', '82.125758', 'destination_Courtyard-Bilaspur.html'],
		['<b>Courtyard Hinjewadi</b><br>S.No – 19&20, <br>Rajiv Gandhi Infotech Park,<br>Phase 1 Hinjewadi Pune,<br>Maharashtra 411057, <br>India<br><br><b>Ph: +91-20-42122222</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '18.591245', '73.746807', 'destination_Courtyard-Hinjewadi.html'],
		['<b>JW Marriott Mussoorie Walnut Grove Resort and Spa</b><br>Village - Siya,<br>Kempty Fall Road,<br>Tehri Garhwal 248179,<br>Uttrakhand<br>India<br><br><b>Ph: +91-135-2635700</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '30.481474', '78.046532', 'destination_JW-Marriott-Mussoorie-Walnut-Grove-Resort-Spa.html'],
		['<b>Bengaluru Marriott Hotel Whitefield</b><br>Plot No 75,<br>EPIP Area, Whitefield,<br>Bengaluru - 560 066, <br>India<br><br><b>Ph: +91-80-49435000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '12.979077', '77.728094', 'destination_Bengaluru-Marriott-Hotel-Whitefield.html'],
		['<b>Courtyard Gurgaon</b><br>Plot no - 27 B,<br>Sector Road, B Block, Sushant Lok - 1,<br>Sector 27  Gurgaon,<br>Haryana  122 002,  <br>India<br><br><b>Ph: +91-124-488-8444</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '28.460927', '77.080393', 'destination_Courtyard-Gurgaon.html'],
		['<b>Fairfield by Marriott Bengaluru Rajajinagar</b><br>59th C Cross,<br>4th M Block, Rajaji Nagar,<br>Bengaluru  560 010, <br>India<br><br><b>Ph: +91-80-49470000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '12.983116', '77.558529', 'destination_Fairfield-by-Marriott-Bengaluru-Rajajinagar.html'],
		['<b>Courtyard Kochi Airport</b><br>VIP Road Opp.Kochi International Airport ,<br>Nedumbassery ,<br>Vappalassery P.O.,<br>Kochi 683572, <br>India.<br><br><b>Ph: +91-484-6693344</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '10.159780', '76.383511', 'destination_Courtyard-Kochi-Airport.html'],
		['<b>Courtyard by Marriott Mumbai International Airport</b><br>CTS 215,<br>opposite Sangam BIG Cinemas,<br>Andheri Kurla Road,<br>Andheri East, <br>Mumbai  400059, <br>India.<br><br><b>Ph: +91-22-6136-9999</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '19.114175', '72.864364', 'destination_Courtyard-Mumbai-International-Airport.html'],
		['<b>Courtyard Bengaluru Outer Ring Road</b><br>Global Technology Park, <br>Outer Ring road,<br>Marathahalli, <br>Sarjapur 560103, <br>India.<br><br><b>Ph: +91-80-71203040</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '12.928070', '77.682503', 'destination_Courtyard-Bengaluru-Outer-Ring-Road.html'],
		['<b>Fairfield Bengaluru Outer Ring Road</b><br>Global Technology Park, <br>Outer Ring road,<br>Marathahalli, <br>Sarjapur 560103, <br>India.<br><br><b>Ph: +91-80-71203040</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '12.928070', '77.682503', 'destination_Fairfield-Bengaluru-Outer-Ring-Road.html'],
		['<b>JW Marriott Bengaluru</b><br>24/1,<br>Vittal Mallya Road,<br>Bengaluru - 560001,<br>India.<br><br><b>Ph: +91-80-67188552</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '12.972536', '77.594784', 'destination_JW-Marriott-Bengaluru.html'],
		['<bCourtyard Pune Chakan</b><br>MIDC Chakan Industrial Area Phase I, <br>Talegaon Chakan Road,<br>Khalumbre, <br>Pune 410501<br>India.<br><br><b>Ph: +91-2135666666</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '18.744626', '73.788128', 'destination_Courtyard-Pune-Chakan.html'],
		['<b>Hyderabad Marriott Hotel & Convention Centre</b><br>Tank Bund Road, <br>Opposite Hussain Sagar Lake,<br>Hyderabad  500080<br>India.<br><br><b>Ph: +91-40-27522999</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '17.424231', '78.424231', 'destination_Hyderabad-Marriott-Hotel&Convention-Centre.html'],
		['<b>Courtyard Hyderabad</b><br>1-3-1024, <br>Lower Tank Bund Road,<br>Hyderabad  500080<br>India.<br><br><b>Ph: +91-40-2752-1222</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '17.423538', '78.487728', 'destination_Courtyard-Hyderabad.html'],
		['<b>Renaissance Lucknow</b><br>Ramdev Nagar Cross Road, <br>Satellite Road, <br>Ahmedabad - 380015, <br>India.<br><br><b>Ph: +91-7966185000</b><br><br><b>Mail: <a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></b>', '26.852693', '80.973022', 'destination_Renaissance-Lucknow.html'],
		
		
		
		
	];
      function initialize() {
        var map_canvas = document.getElementById('map_canvas'),
        map_options = {
          center: new google.maps.LatLng(22.00, 77.00),
          zoom: 5,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          scrollwheel: true,
          navigationControl: true,
          mapTypeControl: true,
          scaleControl: true,
          draggable: true,
          streetViewControl: true,
          disableDefaultUI: false,
          minZoom:3
        },
        map = new google.maps.Map(map_canvas, map_options),marker;
        for (var i = 0; i < myMap.length; i++) {
			var infoText = myMap[i][0],
			thisinfowindow = new google.maps.InfoWindow({
				content: infoText,
				goes: myMap[i][3]
			}),
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(myMap[i][1], myMap[i][2]),
				map: map,
				icon: 'Images/mariott_logo_map.png',
				infowindow: thisinfowindow
			});
			google.maps.event.addListener(marker, "mouseover", function() {
				this.infowindow.open(map, this)
			});
			google.maps.event.addListener(marker, 'mouseout', function() {
				this.infowindow.close();
			});
			google.maps.event.addListener(marker, 'click', function() {
				window.open(this.infowindow.goes, "_blank");
			});
        }
      }
      google.maps.event.addDomListener(window, 'load', initialize);
 </script> 

    <!-- Tracking Code -->
<script src='https://static.getclicky.com/js'></script><script>try {clicky.init(100849934);} catch (e) {}</script><noscript><img height='1' width='1' src='http://static.getclicky.com/100849934ns.gif' /></noscript>
<script type='text/javascript' langauge='javascript'>document.write(unescape("%3Cscript src='" + "Scripts/sslpathanalyzer.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type='text/javascript' langauge='javascript'>fnTrackUrl('51620749-5585-420a-baf3-097a1bf718ac');</script>
    <!-- Tracking Code -->
</body>
</html>
