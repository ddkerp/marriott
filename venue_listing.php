<?php
require_once("includes.php");
$db  = Database::getDatabase();
$rows = $db->getRows("SELECT v.* FROM venue v LEFT JOIN city_master c ON (v.city_id = c.id) WHERE v.status=1 ORDER by c.city_name ASC");
$cities = $db->getRows("SELECT c.id,c.city_name FROM venue v JOIN city_master c ON (v.city_id = c.id) WHERE v.status=1");
//printr($rows);
$list_block="";
$city_li = "";
$city_options = "";
foreach ($cities as $city){
	$city_li = $city_li.'<li data-filter="'.$city['id'].'">'.$city['city_name'].'</li>'.PHP_EOL;
	$city_options = $city_options.'<option value="'.$city['id'].'" data-filter="'.$city['id'].'">'.$city['city_name'].'</option>'.PHP_EOL;
}
foreach($rows as $row){
 $list_block = $list_block.'<div class="col-md-4 col-sm-6 col-xs-12 col-xxs-12 filtr-item margin-B20 '.$row['city'].'" data-category="'.$row['city_id'].'" data-sort="'.$row['city'].'"> <a href="destination/'.strtolower(str_replace(' ','_',$row['name'])).'">
          <div class="hovereffect"> <img src="Images/Venue/'.$row['image'].'" alt="'.$row['name'].'" />
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"/> <img src="Images/share.svg"/> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">'.$row['name'].'</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">'.$row['largest_hall_capacity'].'</span> <br />
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">'.$row['banquet_halls'].' </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">'.$row['rooms'].'</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>'.$row['name'].'</h2>
            </div>
          </div>
          </a> </div>';
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><meta name='description' content='Marriot - the one-stop solution for dream destination weddings. Weddings at Marriot mean exotic wedding venues and tastefully decorated wedding halls. Top wedding destinations in India with best in class banquet halls for your marriage.'><meta name='keywords' content='Destination Wedding, Wedding Destinations, Marriage Halls, Wedding Venues, Banquet Halls, Wedding Hall, Best Wedding Destinations in India, Top Wedding Destinations, Dream Wedding Destinations'><title>Best Weddings in India | Dream Wedding Destination Venues, Marriage Halls at Marriot, India</title><link href="Images/favicon.png" rel="shortcut icon"><link href="CSS/style.css" rel="stylesheet" type="text/css" /><script src="Scripts/modernizr.custom.js"></script><script>(function(i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function() {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1; a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', 'UA-53601335-1', 'auto');ga('send', 'pageview');</script>
</head>

<body class="bgGrey-lighter3">
<div class="loader"></div>
<!-- Header -->
<header>
    <div class="container-fluid" id="banner">
    <div class="row">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
              <div class="item t_banner active "> <img src="Images/venues-banner-new.jpg" alt="..." class="w3-animate-zoom">
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
<!-- Venue Listing  Starts-->
<section id="venue_page" class="">
      <div class="container">
    <div class="row margin-T50">
          <div class="margin-B10 venue_list ">
        <div class="col-md-3 col-sm-6 col-xs-6"> <span class="pull-left row">Find your venue</span> </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
              <div class="row dropdown">
            <button class="btn btn-default dropdown-toggle input-xlarge simplefilter" type="button" id="findVenue" data-toggle="dropdown">Select  City <span class="caret"> <img src="Images/readmore.png"  alt="dropdown" /></span></button>
            <ul class="dropdown-menu " role="menu" aria-labelledby="findVenue" >
                  <li class="active" data-filter="all">All</li>
                  <?php echo $city_li; ?>
                </ul>
            <select  id="" class="simplefilter"   style="display:none">
                  <option value="" class="active" data-filter="all">Select all City</option>
                  <?php echo $city_options; ?>
                </select>
          </div>
            </div>
        <div class="col-md-7 col-sm-12 searc_venue"> <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" placeholder="Search by brand, category, city, etc..." name="filtr-search" data-search/>
          <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="input-6"> <span class="input__label-content input__label-content--hoshi"></span> </label>
          </span> <span class="search_icon"><i class="icon-search-medium icon-lg liac"></i></span> </div>
        <div class="clearfix"></div>
      </div>
          <div class="clearfix"></div>
        </div>
  </div>
    </section>
<div class="clearfix"></div>
<section id="noresults" class="bgGrey-lighter3">
      <div class="container">
    <div class="row margin-T50 margin-B100">
                <h3 class="text-center revealOnScroll" data-animation="fadeInUp">Sorry! No search results found</h3>
                <p class="text-center revealOnScroll" data-animation="fadeInUp"> <i class="icon-decor-glyph-medium liac icon-lg"></i></p>
            </div>
            <div class="clearfix"></div>
</div>
</section>
<section id="venue_listing" class="bgGrey-lighter3">
      <div class="container">
    <div class="row margin-T50 margin-B150">
          <div class="margin-B10 filtr-container">
		  <?php
		   echo $list_block;
		  ?>
       
          <div class="clearfix"></div>
        </div>
  </div>
    </section>
<div class="clearfix"></div>
<!-- Footer -->

<footer id="footer_full">&nbsp;</footer>

<!-- // Footer --> 

<script src="Scripts/plugin.js"></script>
<!--<script src="Scripts/bootstrap.min.js"></script><script src="Scripts/custom_js.js"></script>--> 
<script src="Scripts/classie.js"></script> 
<script src="Scripts/jquery.filterizr.js"></script> 
<!-- Kick off Filterizr --> 
<script type="text/javascript">
        $(function() {
            //Initialize filterizr with default options
            $('.filtr-container').filterizr();
			  $('.dropdown-menu li').click(function() {
        $('.dropdown-menu li').removeClass('active');
        $(this).addClass('active');
		 $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="caret"> <img src="Images/readmore.png"  alt="dropdown" /></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
    });
        });
    </script> 
<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}
				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}
					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );
				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}
				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script> 
    <!-- Tracking Code -->
<script src='https://static.getclicky.com/js'></script><script>try {clicky.init(100849934);} catch (e) {}</script><noscript><img height='1' width='1' src='http://static.getclicky.com/100849934ns.gif' /></noscript>
<script type='text/javascript' langauge='javascript'>document.write(unescape("%3Cscript src='" + "Scripts/sslpathanalyzer.js' type='text/javascript'%3E%3C/script%3E"));</script>
<script type='text/javascript' langauge='javascript'>fnTrackUrl('51620749-5585-420a-baf3-097a1bf718ac');</script>
    <!-- Tracking Code -->


</body>
</html>