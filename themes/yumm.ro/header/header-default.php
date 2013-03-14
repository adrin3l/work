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
$template_url = get_bloginfo('template_url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<?php wp_head(); ?>
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
	<script type='text/javascript' src="<?php echo $template_url.'/js/script.js';?>"> </script>
	<?php
	// Javascript for threaded comments
	if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>
	
	
</head>

<body>
<div id="header">
    <div id="mini-wrap">	
    	<a id="logo" href="<?php echo site_url();?>">
			<img title="CLick to return to the homepage" alt="Logo Yumm.ro" src="<?php echo $template_url; ?>/images/yumm.png">
			</a>
			<p id="slogan">Peste 1000 de meniuri de comandat acasa intr-un singur loc.</p>
		<p id="apreciaza">Apreciaza-ne!</p>
    </div>
</div>
<div id="wrapper">

	
        <div id="main-menu">

        	<?php 
        	$args = array('menu'=>'Header', 'menu_class'=>"navi");
				wp_nav_menu( $args );
			?>
       
                <div id="social">
                <a href="#"><img src="<?php echo $template_url; ?>/images/yumm-facebook.png" alt="facebook link" ></a>
                <a href="#"><img src="<?php echo $template_url; ?>/images/yumm-twitter.png" alt="twitter link" ></a>
                <a href="#"><img src="<?php echo $template_url; ?>/images/yumm-youtube.png" alt="youtube link" ></a>
                </div>   
            </div>
            

            <?php 
            $orase = get_terms(array('oras'), array('hide_empty'=>false));
            $meniuri = get_terms(array('meniu'), array('hide_empty'=>false));
          //  var_dump_pre($orase);
?>
            <div id="cauta">
                <div id="unde">
                    <label>Unde?</label><br>
                    <select id="oras">
                        <option>Alege Oras</option>
                        <?php 
                        	foreach ($orase as $oras){

                        		echo "<option value='$oras->slug'>$oras->name</option>";
                        	}

                        ?>
                    </select>
                  
            </div>
            <div id="ce">
                    <label>Ce comanzi?</label><br>
                    <select id="meniu">
                        <option>Alege Meniu</option>
                       <?php 
                        	foreach ($meniuri as $meniu){

                        		echo "<option value='$meniu->slug'>$meniu->name</option>";
                        	}

                        ?>
                    </select>
                </div>
                <div  id="find"><a href="#" id="gaseste">Gaseste-mi un meniu</a></div>
            </div>