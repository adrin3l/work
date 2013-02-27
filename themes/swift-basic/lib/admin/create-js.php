<?php
function swift_generate_js(){
	GLOBAL $wp_filesystem;
	GLOBAL $swift_options;
	GLOBAL $swift_design_options;

	$js = '';

	if( 1 || swift_is_pagetemplate_active( 'news-paper-template.php' ) || isset( $swift_options['slider_enable'] ) && $swift_options['slider_enable'] ){
		$filename = THEME_DIR . '/js/jquery.flexslider-min.js';
		$js .= $wp_filesystem->get_contents( $filename ) ;

		$js .= "/* Activating slider */ \n";
		$js .= "jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({slideshowSpeed:".$swift_options['slider_speed'].",animationDuration: 600});
  });";
	}

	if( !(isset( $swift_design_options['enable_fixed_height_mag'] ) && $swift_design_options['enable_fixed_height_mag']) ){
		$filename = THEME_DIR . '/js/jquery.masonry.min.js';
		$js .= $wp_filesystem->get_contents( $filename ) ;
	}

	if( isset($swift_design_options['dropdown_animation_enable']) && $swift_design_options['dropdown_animation_enable'] ){
		$filename = THEME_DIR . '/js/dropdown-animation.js';
		//$js .= $wp_filesystem->get_contents( $filename ) ;

	}

	$sticky_js = 'jQuery(document).ready(function(){';
	$sticky_js .= 'if(!(jQuery(window).width()<800)){';
	if( isset($swift_design_options['sticky_nav']) && $swift_design_options['sticky_nav']){
		$sticky_js .= 'jQuery("#below-logo-container").sticky({topSpacing:0,bottomSpacing:0});';
		$sticky = 1;
		$sticky_nav = 1;
	}
	if( isset($swift_design_options['sticky_nav_ad']) && $swift_design_options['sticky_nav_ad']){
		if($sticky_nav){
			$sticky_js .= 'var nav_height = jQuery("#below-logo-container").outerHeight();';
		}else{
			$sticky_js .= 'var nav_height = 0;';
		}
		$sticky_js .= 'jQuery("#nav-ad-container").sticky({topSpacing:nav_height,bottomSpacing:0});';

		$sticky = 1;
		$sticky_nav_ad =1;
	}

	if( isset($swift_design_options['sticky_sb']) && $swift_design_options['sticky_sb']){
		$sticky_js .= 'var footer_height = 40+jQuery("#footer-container").height()+jQuery("#copyright-container").outerHeight();';
		$sticky_js .= 'var top_spacing = 20;';
		if($sticky_nav){
			$sticky_js .= 'top_spacing  = top_spacing+jQuery("#below-logo-container").outerHeight();';
		}
		if($sticky_nav_ad){
			$sticky_js .= 'top_spacing  = top_spacing+jQuery("#nav-ad-container").outerHeight();';
		}
		$sticky_js .= 'jQuery("#sticky").sticky({topSpacing:top_spacing,bottomSpacing:footer_height});';
		$sticky = 1;
	}

	$sticky_js .=	'}});';

	if($sticky){
		$filename = THEME_DIR .'/js/jquery.sticky.js';
		$js .= $wp_filesystem->get_contents( $filename ) ;
		$js .= $sticky_js;
	}
	$filename = THEME_DIR .'/js/swift-scripts.js';
	$js .= $wp_filesystem->get_contents( $filename ) ;

	return $js;

}
?>