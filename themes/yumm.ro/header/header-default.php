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

    <!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $template_url.'/plugins/flexislider/demo/css/demo.css';?>" /> -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $template_url.'/plugins/flexislider/demo/css/shCore.css';?>" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $template_url.'/plugins/flexislider/demo/css/shThemeDefault.css';?>" />
    
    <script type='text/javascript' src="<?php echo $template_url.'/js/script.js';?>"> </script>
	
    <script type='text/javascript' src="<?php echo $template_url.'/plugins/flexislider/jquery.flexslider.js';?>"> </script>
    <script type='text/javascript' src="<?php echo $template_url.'/plugins/flexislider/demo/js/modernizr.js';?>"> </script>
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
            // $orase = get_terms(array('oras'), array('hide_empty'=>false));
            // $meniuri = get_terms(array('meniu'), array('hide_empty'=>false));
          //  var_dump_pre($orase);

            $orase = wp_get_nav_menu_items( 'orase');
            $meniuri = wp_get_nav_menu_items( 'meniuri');
?>
            <div id="cauta">
                <div id="unde">
                    <label>Unde?</label><br>
                    <select id="oras">
                        <option value=''>Alege Oras</option>
                        <?php 
                        	foreach ($orase as $oras){

                                if($oras->object == 'oras'){
                                    $term = get_term_by('id', $oras->object_id, 'oras');
                        		    echo "<option value='$term->slug'>$oras->title</option>";
                                }
                        	}

                        ?>
                    </select>
                  
            </div>
            <div id="ce">
                    <label>Ce comanzi?</label><br>
                    <select id="meniu">
                        <option value=''>Alege Meniu</option>
                       <?php 
                        	foreach ($meniuri as $meniu){
                                if($meniu->object == 'meniu'){
                                    $term = get_term_by('id', $meniu->object_id, 'meniu');
                        		    echo "<option value='$term->slug'>$meniu->title</option>";
                                }
                        	}

                        ?>
                    </select>
                </div>
                <div  id="find"><a href="#" id="gaseste">Gaseste-mi un meniu</a></div>
            </div>
            <div class="breadcrumbs">
                <?php if(function_exists('bcn_display'))
                {
                    global $wp_query;
                    $is_meniu = $wp_query->query_vars['meniu-oras'];
                    $meniu = get_term_by('slug', $is_meniu, 'meniu'); 
                    $oras = $wp_query->query_vars['oras'];
                    $oras = get_term_by('slug', $oras, 'oras'); 
                    ob_start();
                    bcn_display();
                    $breadcrumb = ob_get_clean();
                    //var_dump_pre($is_meniu);
                    //var_dump_pre($oras);
                    if($is_meniu){

                        $link = get_term_link($oras->slug, 'oras');

                        //var_dump_pre($link);

                        if(!is_wp_error($link)){
                            $adress = "<a href='$link'>$oras->name</a>";

                            $breadcrumb = str_replace($oras->name, $adress, $breadcrumb);

                            $breadcrumb .= " > $meniu->name";
                        }

                    }
                    echo $breadcrumb;
                }?>
            </div>
            <?php

           // var_dump_pre( wp_get_nav_menu_items( 'orase') );