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
$template_url = get_bloginfo('template_url');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="text/css" http-equiv="Content-Style-Type">
	<meta content="IE=7" http-equiv="X-UA-Compatible">
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ); ?></title>

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'carrington-jam' ), wp_specialchars( get_bloginfo('name'), 1 ) ) ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />

	<script type='text/javascript' src="<?php echo $template_url.'/js/script.js';?>"> </script>
	
	<?php wp_head(); ?>
</head>
<style>
.ConferenceConvenor {
	text-align: center;
}
</style>
<body id="page1" onload="P7_initPM(0,0,1,0,10)">
<div id="main-tail">
  <div id="main-tail-top">
    <div id="main-tail-bot">
      <div id="main">
        <!-- header -->
        <div id="header">

        	<?php 
        	$args = array('menu'=>'Header', 'menu_id'=>"navi");
				wp_nav_menu( $args );
			?>
         <!--  <ul id="navi">
            <li><a href="contact_us.shtml">Contact Us</a></li>
            <li><a href="faq.shtml">FAQ</a></li>
            <li><a href="privacy_policy.shtml">Privacy Statement</a></li>
          </ul> -->
        </div>