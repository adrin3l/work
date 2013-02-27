<?php

// set content width
if ( ! isset( $content_width ) ) $content_width = 558;

add_action( 'after_setup_theme', 'sp_after_setup' );

function sp_after_setup(){
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'standardpack', get_template_directory() . '/languages' );
 
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);
	
	add_theme_support('automatic-feed-links');
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	
	//wp_nav_menu()
	register_nav_menus(
		array( 
		'primary-nav' => __( 'Primary', 'standardpack' ),
		'top' => __( 'Top Menu', 'standardpack' )
		)
	);
	
        // WordPress 3.4+
        if ( function_exists('get_custom_header')) {
            
        add_theme_support('custom-background');
        
        } else {
        
        // Backward Compatibility
        
        add_custom_background();
        
        }

        // WordPress 3.4+
        if (function_exists('get_custom_header')) {
            
        add_theme_support('custom-header', array (
           'default-image'            => get_template_directory_uri() . '/images/headerimg.png',
           'header-text'            => false,
           'flex-width'             => false,
           'width'                    => 50,
           'flex-height'            => false,
           'height'                    => 50,
           'admin-head-callback'    => 'sp_admin_header_style',)
		   );
       
	   		// gets included in the admin header
        function sp_admin_header_style() {
            ?><style type="text/css">
                .appearance_page_custom-header #headimg {
					background: gray;
					background-position: 50% 50%;				
					background-repeat:no-repeat;
					border:none;
					padding: 25px;
				}
             </style><?php
        }	
	   
       } else {
           
        // Backward Compatibility

        define('HEADER_TEXTCOLOR', '');
        define('HEADER_IMAGE', '%s/images/headerimg.png'); // %s is the template dir uri
        define('HEADER_IMAGE_WIDTH', 50); // use width and height appropriate for your theme
        define('HEADER_IMAGE_HEIGHT', 50);
        define('NO_HEADER_TEXT', true);
        
        
        // gets included in the admin header
        function sp_admin_header_style() {
            ?><style type="text/css">
					#headimg {
						background-color: gray;
						background-position: 50% 50%;
						background-repeat: no-repeat;
						height: <?php echo HEADER_IMAGE_HEIGHT;?>px;
						width: <?php echo HEADER_IMAGE_WIDTH;?>px;
						padding: 25px;
					}
					#headimg h1, #headimg #desc {
						display: none;
					}
			</style><?php
         }
		add_custom_image_header( '', 'sp_admin_header_style' );    
     }
}
 
// Custom callback to list comments
function sp_custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php sp_commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'standardpack'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'standardpack'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'standardpack') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','standardpack'),
                    'login_text' => __('Log in to reply.','standardpack'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
        ?>
<?php } // end custom_comments

// Custom callback to list pings
function sp_custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'standardpack'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'standardpack'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'standardpack') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

add_action( 'wp_head', 'sp_favicon' );

function sp_favicon(){
	$sp_options = get_option('sp_theme_options');
	if (!empty( $sp_options['favicon'] ) ): ?>
		<link rel="Shortcut Icon" href="<?php echo esc_url($sp_options['favicon']); ?>" type="image/x-icon" />
	<?php
	endif;
}

add_action( 'wp_enqueue_scripts', 'sp_enqueue_scripts' );

function sp_enqueue_scripts(){
	if( is_admin() )
		return;
	if ( is_singular() && get_option( 'thread_comments' )  ) wp_enqueue_script( 'comment-reply' );
}


//Retrieve Theme Options Data
global $sp_options;
$sp_options = get_option('sp_theme_options'); 

$functions_path = get_template_directory() . '/functions/';
//Theme Options
require_once ($functions_path . 'theme-options.php'); 

//Redirect to Theme Options Page on Activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" )
	wp_redirect( 'admin.php?page=theme-options.php' );

//Analytics
function sp_analytics() {
	global $sp_options;
	$sp_options = get_option('sp_theme_options');
	global $sp_themename, $sp_shortname, $sp_version, $sp_settings, $sp_option_group, $sp_option_name;	// need these globals 
	if ( isset ($sp_options['ga_code']) &&  ($sp_options['ga_code']!="") ) {
	$output = '<script type="text/javascript">'."\n";
	$output .= $sp_options['ga_code'] . "\n";
	$output .= '</script><!-- end of analytics -->'."\n";
	echo stripslashes($output);
	}
}
add_action('wp_head', 'sp_analytics');

// Get wp_nav_menu() fallback, wp_page_menu(), to show a home link
function sp_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sp_page_menu_args' );

//Add a title if post has no post title
add_filter('the_title', 'sp_title');

function sp_title($title) {
    if ($title == '') {
        return 'Untitled';
    } else {
        return $title;
    }
}

// Produces an avatar image with the hCard-compliant photo class
function sp_commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 50 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link

// For category lists on category archives: Returns other categories except the current one (redundant)
function sp_cats_meow($glue) {
    $current_cat = single_cat_title( '', false );
    $separator = "\n";
    $cats = explode( $separator, get_the_category_list($separator) );
    foreach ( $cats as $i => $str ) {
        if ( strstr( $str, ">$current_cat<" ) ) {
            unset($cats[$i]);
            break;
        }
    }
    if ( empty($cats) )
        return false;
 
    return trim(join( $glue, $cats ));
} // end cats_meow

// For tag lists on tag archives: Returns other tags except the current one (redundant)
function sp_tag_ur_it($glue) {
    $current_tag = single_tag_title( '', '',  false );
    $separator = "\n";
    $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
    foreach ( $tags as $i => $str ) {
        if ( strstr( $str, ">$current_tag<" ) ) {
            unset($tags[$i]);
            break;
        }
    }
    if ( empty($tags) )
        return false;
 
    return trim(join( $glue, $tags ));
} // end tag_ur_it

add_action( 'widgets_init', 'sp_widgets_init' );

// Register widgetized areas
function sp_widgets_init() {
    // Area 1
    register_sidebar( array (
    'name' => __('Sidebar Primary Widget Area','standardpack'),
    'id' => 'primary_widget_area',
	'description' => __('The main widget area, most often used as a sidebar','standardpack'),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
 
    // Area 2
    register_sidebar( array (
    'name' => __('Sidebar Secondary Widget Area','standardpack'),
    'id' => 'secondary_widget_area',
	'description' => __('The second most important widget area, most often used as a secondary sidebar','standardpack'),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
    // Area 3
    register_sidebar( array (
    'name' => __('Header Widget Area','standardpack'),
    'id' => 'header_widget_area',
	'description' => __('Displayed within the site&#39;s header area','standardpack'),
    'before_widget' => '<li id="headerbanner" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  
	// Footer area 
  	register_sidebar(
		array(
			'name' => __('Footer Left','standardpack'),
			'id' => 'footer_left',
			'description' => __('Displayed within the site&#39;s left footer area','standardpack'),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Middle','standardpack'),
			'id' => 'footer_middle',
			'description' => __('Displayed within the site&#39;s middle footer area','standardpack'),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'name' => __('Footer Right','standardpack'),
			'id' => 'footer_right',
			'description' => __('Displayed within the site&#39;s right footer area','standardpack'),
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		)
	);
  
  
} // end sp_widgets_init
 
 // sp_pagination
function sp_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<ul class='paging'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? "<li><a href='" . get_pagenum_link($i) . "' class='current' >" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
        echo "</ul>\n";
    }
}