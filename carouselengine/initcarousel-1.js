jQuery(document).ready(function(){
    var scripts = document.getElementsByTagName("script");
    var jsFolder = "";
    for (var i= 0; i< scripts.length; i++)
    {
        if( scripts[i].src && scripts[i].src.match(/initcarousel-1\.js/i))
            jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);
    }
    if ( typeof html5Lightbox === "undefined" )
    {
        html5Lightbox = jQuery(".html5lightbox").html5lightbox({
            skinsfoldername:"",
            jsfolder:jsFolder,
            barheight:64,
            showtitle:true,
            showdescription:false,
            shownavigation:true,
            thumbwidth:80,
            thumbheight:60,
            thumbtopmargin:12,
            thumbbottommargin:8,
            titlebottomcss:'{color:#fff; font-size:18px;font-family:"Merriweather";overflow:hidden; text-align:center;font-weight: 400;    font-style: italic;}',
            descriptionbottomcss:'{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:center; margin:4px 0px 0px; padding: 0px;}'
        });
    }
    jQuery("#amazingcarousel-1").amazingcarousel({
        jsfolder:jsFolder,
        width:300,
        height:300,
        skinsfoldername:"",
        interval:3000,
        itembottomshadowimagetop:99,
        donotcrop:false,
        random:false,
        showhoveroverlay:true,
        rownumber:1,
        height:300,
        arrowheight:48,
        showbottomshadow:false,
        itembackgroundimagewidth:100,
        imageheight:300,
        skin:"ReadMore",
        responsive:true,
        lightboxtitlebottomcss:"{color:#333; font-size:14px;font-family:'Merriweather'; overflow:hidden; text-align:center;}",
        enabletouchswipe:true,
        navstyle:"none",
        backgroundimagetop:-40,
        arrowstyle:"always",
        bottomshadowimagetop:95,
        hidehoveroverlayontouch:false,
        continuous:false,
        itembackgroundimagetop:0,
        hoveroverlayimage:"",
        itembottomshadowimage:"itembottomshadow-100-98-3.png",
        lightboxshowdescription:false,
        width:300,
        navswitchonmouseover:false,
        showhoveroverlayalways:false,
        transitioneasing:"easeInOutExpo",
        lightboxshownavigation:true,
        showitembackgroundimage:false,
        itembackgroundimage:"",
        playvideoimagepos:"center",
        circular:true,
        arrowimage:"arrows-48-48-4.png",
        scrollitems:1,
        direction:"horizontal",
        lightboxdescriptionbottomcss:"{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:center; margin:4px 0px 0px; padding: 0px;}",
        supportiframe:false,
        navimage:"bullet-16-16-0.png",
        backgroundimagewidth:110,
        showbackgroundimage:false,
        lightboxbarheight:64,
        showplayvideo:true,
        spacing:4,
        lightboxthumbwidth:80,
        navdirection:"horizontal",
        itembottomshadowimagewidth:100,
        backgroundimage:"",
        lightboxthumbtopmargin:12,
        autoplay:false,
        lightboxnogroup:false,
        arrowwidth:48,
        transparent:false,
        continuousduration:2500,
        bottomshadowimage:"bottomshadow-110-95-0.png",
        scrollmode:"item",
        navmode:"page",
        lightboxshowtitle:true,
        lightboxthumbbottommargin:8,
        arrowhideonmouseleave:1000,
        showitembottomshadow:false,
        lightboxthumbheight:60,
        navspacing:8,
        pauseonmouseover:true,
        imagefillcolor:"FFFFFF",
        playvideoimage:"playvideo-64-64-0.png",
        transitionduration:1000,
        visibleitems:2,
        imagewidth:300,
        usescreenquery:false,
        bottomshadowimagewidth:110,
        screenquery:{
			desktop: {
		screenwidth: 1900,
		visibleitems: 4
	},
	tablet: {
		screenwidth: 900,
		visibleitems: 4
	},
	mobile: {
		screenwidth: 600,
		visibleitems: 3
	}
},
        navwidth:16,
        loop:0,
        navheight:16
    });
});