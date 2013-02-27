<?php

// This file is part of the Carrington JAM Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

$s = get_query_var('s');

if (get_option('permalink_structure') != '') {
	$search_title = '<a href="'.trailingslashit(get_bloginfo('url')).'search/'.urlencode($s).'">'.htmlspecialchars($s).'</a>';
}
else {
	$search_title = '<a href="'.trailingslashit(get_bloginfo('url')).'?s='.urlencode($s).'">'.htmlspecialchars($s).'</a>';
}

?>

<h1><?php printf(__('Search Results for: %s', 'carrington-jam'), $search_title); ?></h1>

?>
<div id="content">
	<div class="line-ver">
		<div class="wrapper-1">
			<div class="col-1 extra-column" style="height:850px">
				<div class="wrapper-1">
					<?php 
		        		$args = array('menu'=>'Primary', 'menu_id'=>"p7PMnav",'container'=>'');
						wp_nav_menu( $args );
					?>
					<?php get_sidebar('left');?>
				</div>
			</div>
			<div class="col-2" style="height:850px">
				<div class="wrapper-1">
					<?php cfct_loop(); ?>
				</div>
			</div>
			<div class="col-3" style="height:850px">
				<div class="wrapper-1">
					<?php get_sidebar('right'); ?>
				</div>
			</div>
			<div>
				<img width="971" height="189" alt="" src="<?php echo $template_url."/images/mining-bgmed_cropped.gif"; ?>">
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
		<?php
		get_footer();
?>