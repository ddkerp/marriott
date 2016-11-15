// JavaScript Document

jQuery(document).ready(function() {

    // Page Load 
    jQuery(window).load(function() {
        jQuery(".loader").fadeOut("slow");
    })

    // Menu Scrolling   
    jQuery(window).on("scroll", function() {
        if (jQuery(window).scrollTop() > 50) {
            jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("background", "#111416");
            jQuery("header .navbar-default .navbar-nav>li.logo a img").attr("src", "Images/logo_bottom.png");
            jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("min-height", "90px");
            jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("-webkit-transition", ".5s ease-in-out");
            jQuery("header .navbar-default .navbar-nav>li.logo a img").css("-webkit-transition", ".5s ease-in-out");
            jQuery("header .navbar-default .navbar-nav>li.logo").addClass("margin-T-20");
            jQuery("header .navbar-default .navbar-nav>li.logo").css("margin-left", "0px");

        } else {
            //remove the background property so it comes transparent again (defined in your css)
            // jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("background","inherit");
            jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("background", "-webkit-linear-gradient(top, rgba(0,0,0,0.28) 0%,rgba(0,0,0,0) 100%");
            jQuery("header nav.navbar.navbar-default.navbar-fixed-top").css("background", "repeating-linear-gradient(to bottom, rgba(0, 0, 0, 0.28) 0%, rgba(0, 0, 0, 0) 100%)");
            jQuery("header .navbar-default .navbar-nav>li.logo a img").attr("src", "Images/logo.png");
            jQuery("header .navbar-default .navbar-nav>li.logo").removeClass("margin-T-20");
        }
    });

    // Textarea focus

    jQuery('.review_text').each(function() {
        jQuery(this).data('default', this.value);
    }).focusin(function() {
        if (this.value == $(this).data('default')) {
            this.value = '';
        }
    }).focusout(function() {
        if (this.value == '') {
            this.value = $(this).data('default');
        }
    });

    // testimonials readmore
    jQuery('#reviews_testimonials_more').click(function() {
        jQuery('.review_testimonials').css('height', 'auto');
        jQuery('#reviews_testimonials_more').hide();
    });

    // Footer logos
    //jQuery('#footer_full .row.text-center').addClass('footer_img');

    // Header Content

    jQuery("#header_Menu").html('<nav class="navbar navbar-default navbar-fixed-top"><div class="container"><div class="menubar"><div class="navbar-header"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button><div class="responsive_search hide"><div class="form"> <span class="toggle"><i class="icon-search-small icon-md liac"></i></span><form role="search" method="get" id="searchform" action=""><input type="text" placeholder="Search" id="s" name="s" value=""><button type="submit" class="btn" id="searchsubmit"></button></form></div></div><a class="navbar-brand" href="index.html"><img src="Images/logo.png" alt="Shaadi Marriott" /></a></div><div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="nav navbar-nav"><li class="margin-T20 active"><a href="venue_listing.html">Venues</a></li><li class="margin-T20"><a href="facilities.html">Facilities</a></li><li class="margin-T20"><a href="Honeymoon_on_us.html">Honeymoon On Us</a></li><li class="margin-T20 click-off"><a href="#">My Wedding</a></li><li class="logo "><a href="index.html"><img src="Images/logo.png" alt="Shaadi Marriott" /></a></li><li class="margin-T20"><a href="testimonials.html">Testimonials</a></li><li class="margin-T20 click-off"><a href="#">Partners</a></li><li class="margin-T20"><a href="blog.html">Blog</a></li><li class="margin-T20"><a href="contactus.html">Contact Us</a></li></ul><form class="navbar-form navbar-right margin-T20"><div class="input-group margin-T10"><input type="text" class="form-control" aria-label="..." placeholder="Search"><div class="input-group-btn"> <button type="submit" class="btn"><i class="icon-search-small icon-sm liac"></i></button></div></div></form></div><!-- /.navbar-collapse --></div></div><!-- /.container-fluid --></nav>');

    // Header active Menu
    jQuery('header#blog #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#blog #header_Menu .navbar-default .navbar-nav>li:nth-child(8)').addClass('active');

    jQuery('header#contact #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#contact #header_Menu .navbar-default .navbar-nav>li:nth-child(9)').addClass('active');

    jQuery('header#honeymoon_on #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#honeymoon_on #header_Menu .navbar-default .navbar-nav>li:nth-child(3)').addClass('active');

    jQuery('header#testimonials #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#testimonials #header_Menu .navbar-default .navbar-nav>li:nth-child(6)').addClass('active');

    jQuery('header#home #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#thankyou #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');	

    jQuery('header#facilities #header_Menu .navbar-default .navbar-nav>li:nth-child(1)').removeClass('active');
    jQuery('header#facilities #header_Menu .navbar-default .navbar-nav>li:nth-child(2)').addClass('active');

    // Footer Content
    jQuery('#footer_full').html('<div class="container  revealOnScroll" data-animation="fadeInUpShort"><div class="row text-center footer_img"><a href="http://renaissance-hotels.marriott.com/" class="col-xs-6 col-sm-4 col-md-2" target="_blank"> <img src="Images/Footer_logo/Renaissance-Gray.png" alt="Renaissance Hotels" /> </a><a href="http://www.marriott.com/courtyard/travel.mi" class="col-xs-6 col-sm-4 col-md-2" target="_blank"> <img src="Images/Footer_logo/Courtyard-Gray.png" alt="Courtyard" /> </a><a href=" http://jw.marriott.com/" target="_blank" class="col-xs-6 col-sm-4 col-md-2"> <img src="Images/Footer_logo/JWMarriott-Gray.png" alt="JW Marriott" /> </a><a href="http://www.marriott.com/marriott-hotels-resorts/travel.mi" class="col-xs-6 col-sm-4 col-md-2" target="_blank"> <img src="Images/Footer_logo/Marriott-Gray.png" alt="Marriott Hotels &amp; Resorts" /> </a><a href="http://www.marriott.com/executive-apartments/travel.mi" class="col-xs-6 col-sm-4 col-md-2" target="_blank"> <img src="Images/Footer_logo/MEA-Gray.png" alt="Marriott Executive Apartments" /> </a><a href="http://www.ritzcarlton.com/en/Default.htm" class="col-xs-6 col-sm-4 col-md-2" target="_blank"> <img src="Images/Footer_logo/Ritz-Gray.png" alt="The Ritz-Carlton" /> </a></div></div><div class="clearfix"></div><p class="f_border">&nbsp;</p><div class="container padding-T20 "><div class="row"><div class="col-md-9 col-xs-12 text-capitalize copyrights"> © MARRIOTT <span id="year"></span>. All rights reserved. | <a href="http://www.marriott.com/rewards/rewards-program.mi" target="_blank" class="">Marriott Rewards</a> | <a href="http://www.marriott.com/about/terms-of-use.mi" target="_blank">Terms of Use</a> | <a href="http://www.marriott.com/marriott/aboutmarriott.mi" target="_blank">About</a> | <a href="http://www.marriott.com/about/privacy.mi" target="_blank">Privacy &amp; cookie statement </a></div><div class="col-md-3 col-xs-12 text-capitalize pull-right"> <div class="row"><i class="icon-mail-medium liac icon-sm"> </i><span class="copyrights"><a href="mailto:contact@marriottindiaweddings.com">contact@marriottindiaweddings.com</a></span></div></div></div></div>');

    // Year
    var currentDate = new Date();
    var CurrentYear = currentDate.getFullYear();

    $("#year").html(CurrentYear);

    // Animation easing
    /*jQuery.doTimeout(2500, function(){
    	jQuery('.repeat.go').removeClass('go');
    	return true;
    });
    jQuery.doTimeout(2520, function(){
    	jQuery('.repeat').addClass('go');
    	return true;
    });*/

    $(function() {

        var $window = $(window),
            win_height_padded = $window.height() * 1.1,
            isTouch = Modernizr.touch;

        if (isTouch) {
            $('.revealOnScroll').addClass('animated');
        }

        $window.on('scroll', revealOnScroll);

        function revealOnScroll() {
            var scrolled = $window.scrollTop(),
                win_height_padded = $window.height() * 1.1;

            // Showed...
            $(".revealOnScroll:not(.animated)").each(function() {
                var $this = $(this),
                    offsetTop = $this.offset().top;

                if (scrolled + win_height_padded > offsetTop) {
                    if ($this.data('timeout')) {
                        window.setTimeout(function() {
                            $this.addClass('animated ' + $this.data('animation'));
                        }, parseInt($this.data('timeout'), 10));
                    } else {
                        $this.addClass('animated ' + $this.data('animation'));
                    }
                }
            });
            $(".revealOnScroll.animated").each(function(index) {
                var $this = $(this),
                    offsetTop = $this.offset().top;
                if (scrolled + win_height_padded < offsetTop) {
                    //$(this).removeClass('animated fadeInUp zoomIn fadeInRightShort fadeInUpShortZoom fadeInUpShort zoomInShort fadeInDown')
                    $(this).removeClass('animated')
                }
            });
        }

        revealOnScroll();
    });

    // MAC Custom CSS
    if (navigator.userAgent.indexOf('Mac OS X') != -1) {
        jQuery("body").addClass("mac");
    } else {
        jQuery("body").addClass("pc");
    }

    // Banner scaling
    //jQuery('header #carousel-example-generic .item img').addClass('w3-animate-zoom'); 

    //search icon
    //	jQuery('.input__field--hoshi').keyup(function(){
    //        $(".searc_venue .search_icon i").removeClass('icon-search-medium icon-lg');
    //		$(".searc_venue .search_icon i").addClass('icon-cross-medium icon-md');		
    //    });



// Venue Detail Page Review responsive

jQuery('#reviews .review_testimonials .testimonials .col-sm-2.col-xs-3').addClass('col-xs-2');
jQuery('#reviews .review_testimonials .testimonials .col-sm-7.col-xs-9').addClass('col-xs-7');
jQuery('#reviews .review_testimonials .testimonials .col-sm-3.col-xs-12').addClass('col-xs-3');

jQuery('#reviews .review_testimonials .testimonials .col-sm-2.col-xs-3').removeClass('col-xs-3');
jQuery('#reviews .review_testimonials .testimonials .col-sm-7.col-xs-9').removeClass('col-xs-9');
jQuery('#reviews .review_testimonials .testimonials .col-sm-3.col-xs-12').removeClass('col-xs-12');




    // End document ready
});