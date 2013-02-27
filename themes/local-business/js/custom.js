//Menu Init
ddsmoothmenu.init({
	mainmenuid: "menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});


//Gallery
//Prety Photo
jQuery.noConflict();
	  jQuery(document).ready(function(){
				jQuery(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
			});


//Flexslider
//<![CDATA[
 var $j = jQuery.noConflict();
    $j("document").ready(function(){
    $j('.flexslider').flexslider();
});
//]]>  
