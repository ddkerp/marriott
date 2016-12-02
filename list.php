<?php
require 'includes/master.inc.php';
$db  = Database::getDatabase();
$rows = $db->getRows("SELECT * FROM venue");
printr($rows);$list_block="";
foreach($rows as $row){
 $list_block = $list_block.'<div class="col-md-4 col-sm-6 col-xs-12 col-xxs-12 filtr-item margin-B20 '.$row['city'].'" data-category="18" data-sort="'.$row['city'].'"> <a href="destination_Pune.html">
          <div class="hovereffect"> <img src="Images/Venue/'.$row['city'].'.jpg" alt="'.$row['name'].'" />
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
                  <li data-filter="1">Agra</li>
                  <li data-filter="2">Ahmedabad</li>
                  <li data-filter="3">Bengaluru</li>
                  <li data-filter="4">Bhopal </li>
                  <li data-filter="5">Bilaspur</li>
                  <li data-filter="6">Chandigarh</li>
                  <li data-filter="7"> Chennai</li>
                  <li data-filter="8">Goa</li>
                  <li data-filter="9"> Gurgaon</li>
                  <li data-filter="10">Hinjewadi</li>
                  <li data-filter="11">Hyderabad</li>
                  <li data-filter="12">Jaipur</li>
                  <li data-filter="13">Kochi</li>
                  <li data-filter="14">Lucknow</li>
                  <li data-filter="15">Mumbai</li>
                  <li data-filter="16">Mussoorie</li>
                  <li data-filter="17">New Delhi</li>
                  <li data-filter="18">Pune</li>
                  <li data-filter="19"> Raipur</li>
                </ul>
            <select  id="" class="simplefilter"   style="display:none">
                  <option value="" class="active" data-filter="all">Select all City</option>
                  <option value="1" data-filter="1">Agra</option>
                  <option value="2" data-filter="2">Ahmedabad</option>
                  <option value="3" data-filter="3">Bengaluru</option>
                  <option value="4" data-filter="4">Bhopal </option>
                  <option value="5" data-filter="5">Bilaspur</option>
                  <option value="6" data-filter="6">Chandigarh</option>
                  <option value="7" data-filter="7"> Chennai</option>
                  <option value="8" data-filter="8">Goa</option>
                  <option value="9" data-filter="9"> Gurgaon</option>
                  <option value="10" data-filter="10">Hinjewadi</option>
                  <option value="11" data-filter="11">Hyderabad</option>
                  <option value="12" data-filter="12">Jaipur</option>
                  <option value="13" data-filter="13">Kochi</option>
                  <option value="14" data-filter="14">Lucknow</option>
                  <option value="15" data-filter="15">Mumbai</option>
                  <option value="16" data-filter="16">Mussoorie</option>
                  <option value="17" data-filter="17">New Delhi </option>
                  <option value="18" data-filter="18">Pune</option>
                  <option value="19" data-filter="19"> Raipur</option>
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
        <div class="col-md-4 col-sm-6 col-xs-12 col-xxs-12 filtr-item margin-B20 Pune" data-category="18" data-sort="Pune"> <a href="destination_Pune.html">
          <div class="hovereffect"> <img src="Images/Venue/Pune.jpg" alt="JW Marriot Pune" />
            <div class="overlay">
              <div class="pull-right "> <img src="Images/like.svg"/> <img src="Images/share.svg"/> 
                <span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Pune</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">2000</span> <br />
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">12 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">414</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Pune</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Kochi" data-category="13" data-sort="Kochi"> <a href="destination_Kochi.html">
          <div class="hovereffect"><img src="Images/Venue/Kochi.jpg" alt="Kochi Marriot Hotel " />
            <div class="overlay">
              <div class="pull-right "> 
                <img src="Images/like.svg"/> <img src="Images/share.svg"/> <span class="padding10">4.7</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Kochi Marriot Hotel </h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1600</span> <br />
                       Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">11 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">273</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Kochi Marriot Hotel </h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Ahmedabad" data-category="2" data-sort="Ahmedabad"> <a href="destination_Ahmedabad.html">
          <div class="hovereffect"><img src="Images/Venue/Ahmadabad.jpg" alt="Courtyard Ahmedabad" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Ahmedabad</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br />
                        Largest Hall Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">9 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">164</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Ahmedabad</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Mumbai" data-category="15" data-sort="Mumbai"> <a href="destination_SaharMumbai.html">
          <div class="hovereffect"><img src="Images/Venue/Mumbai.jpg" alt="JW Marriot Mumbai Sahar" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Mumbai Sahar</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">450</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">11 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">585</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Mumbai Sahar</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Mumbai" data-category="15" data-sort="Mumbai"> <a href="destination_RenaissanceMumbai.html">
          <div class="hovereffect"> <img src="Images/Venue/RenaissanceMumbai.jpg" alt="Renaissance Mumbai Convention Centre Hotel" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.2</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Renaissance Mumbai Convention Centre Hotel</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1800</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">12 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">600</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Renaissance Mumbai Convention Centre Hotel</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Goa" data-category="8" data-sort="Goa"> <a href="destination_Goa.html">
          <div class="hovereffect"><img src="Images/Venue/Goa.jpg" alt="Goa Marriot Resort &amp; Spa" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.7</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Goa Marriot Resort &amp; Spa</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">101</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Goa Marriot Resort &amp; Spa</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bhopal" data-category="4" data-sort="Bhopal "> <a href="destination_Courtyard_Marriot_Bhopal.html">
          <div class="hovereffect"><img src="Images/Venue/Bhopal.jpg" alt="Courtyard Marriot Bhopal" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Marriot Bhopal </h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1000</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">101</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Marriot Bhopal</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Agra" data-category="1" data-sort="Agra"> <a href="destination_Courtyard_Agra.html">
          <div class="hovereffect"><img src="Images/Venue/Agra.jpg" alt="Courtyard Agra" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Agra</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">189</span> <br />
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
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Mumbai" data-category="15" data-sort="Mumbai"> <a href="destination_JW-Marriot-Mumbai-Juhu.html">
          <div class="hovereffect"><img src="Images/Venue/Mumbai-Juhu.jpg" alt="JW Marriot Mumbai Juhu" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">5.0</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Mumbai Juhu</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1000</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">13 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">355</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Mumbai Juhu</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Chennai" data-category="7" data-sort="Chennai"> <a href="destination_Courtyard-Chennai.html">
          <div class="hovereffect"><img src="Images/Venue/Chennai.jpg" alt="Courtyard Chennai" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.0</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Chennai</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">100</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">236</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Chennai</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Pune" data-category="18" data-sort= "Pune"> <a href="destination_Marriot-Suites-Pune.html">
          <div class="hovereffect"><img src="Images/Venue/Marriot_Pune.jpg" alt="Marriot Suites Pune" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.7</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Marriot Suites Pune</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">150</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">3</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">199</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Marriot Suites Pune</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Jaipur" data-category="12" data-sort="Jaipur"> <a href="destination_Jaipur-Marriot-Hotel.html">
          <div class="hovereffect"><img src="Images/Venue/Jaipur.jpg" alt="Jaipur Marriot Hotel" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Jaipur Marriot Hotel</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">700</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">317</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Jaipur Marriot Hotel</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Delhi" data-category="17" data-sort="New Delhi "> <a href="destination_JW-Marriot-New-Delhi-Aerocity.html">
          <div class="hovereffect"><img src="Images/Venue/Delhi-Aerocity.jpg" alt="JW Marriot New Delhi Aerocity" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot New Delhi Aerocity</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1350</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">523</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot New Delhi Aerocity</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Chandigarh" data-category="6" data-sort="Chandigarh"> <a href="destination_JW-Marriot-Chandigarh.html">
          <div class="hovereffect"><img src="Images/Venue/Chandigarh.jpg" alt="JW Marriot Chandigarh" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.3</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Chandigarh</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">900</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">2</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">164</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Chandigarh</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Raipur" data-category="19" data-sort="Raipur"> <a href="destination_Courtyard-Raipur.html">
          <div class="hovereffect"><img src="Images/Venue/Raipur.jpg" alt="Courtyard Raipur" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Raipur</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">8 </span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">108</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Raipur</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bilaspur" data-category="5" data-sort="Bilaspur"> <a href="destination_Courtyard-Bilaspur.html">
          <div class="hovereffect"><img src="Images/Venue/Bilaspur.jpg" alt="Courtyard Bilaspur" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.3</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Bilaspur</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">600</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">7</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">98</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Bilaspur</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Hinjewadi" data-category="10" data-sort="Hinjewadi"> <a href="destination_Courtyard-Hinjewadi.html">
          <div class="hovereffect"><img src="Images/Venue/Hinjewadi.jpg" alt="Courtyard Hinjewadi" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.4</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Hinjewadi</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1000</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">7</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">153</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Hinjewadi</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Mussoorie" data-category="16" data-sort="Mussoorie"> <a href="destination_JW-Marriot-Mussoorie-Walnut-Grove-Resort-Spa.html">
          <div class="hovereffect"><img src="Images/Venue/Mussoorie.jpg" alt="JW Marriot Mussoorie Walnut Grove Resort and Spa" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.7</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Mussoorie Walnut Grove Resort &amp; Spa</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">350</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">5</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">115</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Mussoorie Walnut Grove Resort &amp; Spa</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bengaluru" data-category="3" data-sort="Bengaluru"> <a href="destination_Bengaluru-Marriot-Hotel-Whitefield.html">
          <div class="hovereffect"><img src="Images/Venue/Bengaluru-Whitefield.jpg" alt="Bengaluru Marriot Hotel Whitefield " />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">5.0</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Bengaluru Marriot Hotel Whitefield </h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">800</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">10</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">324</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Bengaluru Marriot Hotel Whitefield </h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Gurgaon" data-category="9" data-sort=" Gurgaon"> <a href="destination_Courtyard-Gurgaon.html">
          <div class="hovereffect"><img src="Images/Venue/Gurgaon.jpg" alt="Courtyard Gurgaon" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.0</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Gurgaon</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">210</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">4</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">198</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Gurgaon</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bengaluru" data-category="3" data-sort="Bengaluru"> <a href="destination_Fairfield-by-Marriot-Bengaluru-Rajajinagar.html">
          <div class="hovereffect"><img src="Images/Venue/Bengaluru-Rajajinagar.jpg" alt="Fairfield by Marriot Bengaluru Rajajinagar" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Fairfield by Marriot Bengaluru Rajajinagar</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">200</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">4</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">146</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Fairfield by Marriot Bengaluru Rajajinagar</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Kochi" data-category="13" data-sort="Kochi"> <a href="destination_Courtyard-Kochi-Airport.html">
          <div class="hovereffect"><img src="Images/Venue/Kochi-Airport.jpg" alt="Courtyard Kochi Airport " />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Kochi Airport </h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">100</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">3</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">106</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Kochi Airport </h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Mumbai" data-category="15" data-sort="Mumbai"> <a href="destination_Courtyard-Mumbai-International-Airport.html">
          <div class="hovereffect"><img src="Images/Venue/Mumbai-International-Airport.jpg" alt="Courtyard Mumbai International Airport" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.5</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Mumbai International Airport</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">720</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">12</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">334</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Mumbai International Airport</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bengaluru" data-category="3" data-sort="Bengaluru"> <a href="destination_Courtyard-Bengaluru-Outer-Ring-Road.html">
          <div class="hovereffect"><img src="Images/Venue/Bengaluru-Outer-Ring-Road.jpg" alt="Courtyard Bengaluru Outer Ring Road" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Bengaluru Outer Ring Road</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">450</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">7</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">496</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Bengaluru Outer Ring Road</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bengaluru" data-category="3" data-sort="Bengaluru"> <a href="destination_Fairfield-Bengaluru-Outer-Ring-Road.html">
          <div class="hovereffect"><img src="Images/Venue/Bengaluru-Outer-Ring-Road-Fairfield.jpg" alt="Fairfield Bengaluru Outer Ring Road" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.4</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Fairfield Bengaluru Outer Ring Road</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">450</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">7</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">480</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Fairfield Bengaluru Outer Ring Road</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Bengaluru" data-category="3" data-sort="Bengaluru"> <a href="destination_JW-Marriot-Bengaluru.html">
          <div class="hovereffect"><img src="Images/Venue/Bengaluru.jpg" alt="JW Marriot Bengaluru" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.6</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">JW Marriot Bengaluru</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1000</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">9</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">281</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>JW Marriot Bengaluru</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Pune" data-category="18" data-sort="Pune"> <a href="destination_Courtyard-Pune-Chakan.html">
          <div class="hovereffect"><img src="Images/Venue/Chakan.jpg" alt="Courtyard Pune Chakan" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.2</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Pune Chakan</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">300</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">11</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">175</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Pune Chakan</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Hyderabad" data-category="11" data-sort="Hyderabad"> <a href="destination_Hyderabad-Marriot-Hotel&Convention-Centre.html">
          <div class="hovereffect"><img src="Images/Venue/Hyderabad-Convention-Centre.jpg" alt="Hyderabad Marriot Hotel & Convention Centre" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.3</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Hyderabad Marriot Hotel & Convention Centre</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1300</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">17</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">293</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Hyderabad Marriot Hotel & Convention Centre</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Hyderabad" data-category="11" data-sort="Hyderabad"> <a href="destination_Courtyard-Hyderabad.html">
          <div class="hovereffect"><img src="Images/Venue/Hyderabad.jpg" alt="Courtyard Hyderabad" />
            <div class="overlay">
              <div class="pull-right "> 
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.4</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Courtyard Hyderabad</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">1300</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">17</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">114</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Courtyard Hyderabad</h2>
            </div>
          </div>
          </a> </div>
        <div class="col-md-4 col-sm-6 col-xs-12 margin-B20 col-xxs-12 filtr-item Lucknow" data-category="14" data-sort="Lucknow"> <a href="destination_Renaissance-Lucknow.html">
          <div class="hovereffect"><img src="Images/Venue/Lucknow.jpg" alt="Renaissance Lucknow" />
            <div class="overlay">
              <div class="pull-right ">  
                <img src="Images/like.svg"/> <img src="Images/share.svg"/><span class="padding10">4.4</span> </div>
              <div class="destination_detail">
                <div class="clearfix"></div>
                <div class="row margin-T30 margin-B20 Hotel_details">
                  <h3 class="margin-B20">Renaissance Lucknow</h3>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">350</span> <br />
                        Total Capacity</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-6 borderright1px">
                    <div class="text-center">
                      <p class="facts"><span class="">5</span> <br />
                        Banquet Halls</p>
                    </div>
                  </div>
                  <div class="col-sm-4 col-xs-12 row">
                    <div class="text-center">
                      <p class="facts roomFact"><span class="">112</span> <br />
                        Rooms </p>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <h2>Renaissance Lucknow</h2>
            </div>
          </div>
          </a> </div>
      </div>
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
