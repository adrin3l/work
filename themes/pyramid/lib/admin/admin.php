<?php
class PyramidAdmin {
		
		/** Constructor Method */
		function __construct() {
	
			/** Load the admin_init functions. */
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			
			/* Hook the settings page function to 'admin_menu'. */
			add_action( 'admin_menu', array( &$this, 'settings_page_init' ) );		
	
		}
		
		/** Initializes any admin-related features needed for the framework. */
		function admin_init() {
			
			/** Registers admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_register_scripts' ), 1 );
		
			/** Loads admin JavaScript and Stylesheet files for the framework. */
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			
		}
		
		/** Registers admin JavaScript and Stylesheet files for the framework. */
		function admin_register_scripts() {
			
			/** Register Admin Stylesheet */
			wp_register_style( 'pyramid-admin-css-style', esc_url( PYRAMID_ADMIN_URI . 'style.css' ) );
			
			/** Register Admin Scripts */
			wp_register_script( 'pyramid-admin-js-pyramid', esc_url( PYRAMID_ADMIN_URI . 'common.js' ), array( 'jquery-ui-tabs' ) );
			wp_register_script( 'pyramid-admin-js-jquery-cookie', esc_url( PYRAMID_JS_URI . 'jquery.cookie.js' ), array( 'jquery' ) );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for the framework. */
		function admin_enqueue_scripts() {			
		}
		
		/** Initializes all the theme settings page functionality. This function is used to create the theme settings page */
		function settings_page_init() {
			
			global $pyramid;
			
			/** Register theme settings. */
			register_setting( 'pyramid_options_group', 'pyramid_options', array( &$this, 'pyramid_options_validate' ) );
			
			/* Create the theme settings page. */
			$pyramid->settings_page = add_theme_page( 
				esc_html( __( 'Pyramid Options', 'pyramid' ) ),	/** Settings page name. */
				esc_html( __( 'Pyramid Options', 'pyramid' ) ),	/** Menu item name. */
				$this->settings_page_capability(),				/** Required capability */
				'pyramid-options', 								/** Screen name */
				array( &$this, 'settings_page' )				/** Callback function */
			);
			
			/* Check if the settings page is being shown before running any functions for it. */
			if ( !empty( $pyramid->settings_page ) ) {
				
				/** Add contextual help to the theme settings page. */
				add_action( 'load-'. $pyramid->settings_page, array( &$this, 'settings_page_contextual_help' ) );
				
				/* Load the JavaScript and stylesheets needed for the theme settings screen. */
				add_action( 'admin_enqueue_scripts', array( &$this, 'settings_page_enqueue_scripts' ) );
				
				/** Configure settings Sections and Fileds. */
				$this->settings_sections();
				
				/** Configure default settings. */
				$this->settings_default();				
				
			}
			
		}
		
		/** Returns the required capability for viewing and saving theme settings. */
		function settings_page_capability() {
			return 'edit_theme_options';
		}
		
		/** Displays the theme settings page. */
		function settings_page() {
			require( PYRAMID_ADMIN_DIR . 'page.php' );
		}
		
		/** Text for the contextual help for the theme settings page in the admin. */
		function settings_page_contextual_help() {
			
			/** Get the parent theme data. */
			$theme = pyramid_theme_data();
			$AuthorURI = $theme['AuthorURI'];
			$ThemeURI = $theme['ThemeURI'];
		
			/** Get the current screen */
			$screen = get_current_screen();
			
			/** Add theme reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'pyramid-theme',
				'title' => __( 'Theme Support', 'pyramid' ),
				'content' => implode( '', file( PYRAMID_ADMIN_DIR . 'help/support.html' ) ),				
				
				)
			);
			
			/** Add license reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'pyramid-license',
				'title' => __( 'License', 'pyramid' ),
				'content' => implode( '', file( PYRAMID_ADMIN_DIR . 'help/license.html' ) ),				
				
				)
			);
			
			/** Add changelog reference help screen tab. */
			$screen->add_help_tab( array(
				
				'id' => 'pyramid-changelog',
				'title' => __( 'Changelog', 'pyramid' ),
				'content' => implode( '', file( PYRAMID_ADMIN_DIR . 'help/changelog.html' ) ),				
				
				)
			);
			
			/** Help Sidebar */
			$sidebar = '<p><strong>' . __( 'For more information:', 'pyramid' ) . '</strong></p>';
			if ( !empty( $AuthorURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $AuthorURI ) . '" target="_blank">' . __( 'Pyramid Project', 'pyramid' ) . '</a></p>';
			}
			if ( !empty( $ThemeURI ) ) {
				$sidebar .= '<p><a href="' . esc_url( $ThemeURI ) . '" target="_blank">' . __( 'Pyramid Official Page', 'pyramid' ) . '</a></p>';
			}			
			$screen->set_help_sidebar( $sidebar );
			
		}
		
		/** Loads admin JavaScript and Stylesheet files for displaying the theme settings page in the WordPress admin. */
		function settings_page_enqueue_scripts( $hook ) {
			
			/** Load Scripts For Pyramid Options Page */
			if( $hook === 'appearance_page_pyramid-options' ) {
				
				/** Load Admin Stylesheet */
				wp_enqueue_style( 'pyramid-admin-css-style' );
				
				/** Load Admin Scripts */
				wp_enqueue_script( 'pyramid-admin-js-pyramid' );
				wp_enqueue_script( 'pyramid-admin-js-jquery-cookie' );
				
			}
				
		}
		
		/** Configure settings Sections and Fileds */		
		function settings_sections() {
		
			/** Blog Section */
			add_settings_section( 'pyramid_section_blog', 'Blog Options', array( &$this, 'pyramid_section_blog_fn' ), 'pyramid_section_blog_page' );			
			
			add_settings_field( 'pyramid_field_post_style', __( 'Post Style', 'pyramid' ), array( &$this, 'pyramid_field_post_style_fn' ), 'pyramid_section_blog_page', 'pyramid_section_blog' );
			add_settings_field( 'pyramid_field_post_nav_style', __( 'Post Navigation Style', 'pyramid' ), array( &$this, 'pyramid_field_post_nav_style_fn' ), 'pyramid_section_blog_page', 'pyramid_section_blog' );
			
			/** General Section */
			add_settings_section( 'pyramid_section_general', 'General Options', array( &$this, 'pyramid_section_general_fn' ), 'pyramid_section_general_page' );
			
			add_settings_field( 'pyramid_field_analytic', __( 'Use Analytic', 'pyramid' ), array( &$this, 'pyramid_field_analytic_fn' ), 'pyramid_section_general_page', 'pyramid_section_general' );
			add_settings_field( 'pyramid_field_analytic_code', __( 'Enter Analytic Code', 'pyramid' ), array( &$this, 'pyramid_field_analytic_code_fn' ), 'pyramid_section_general_page', 'pyramid_section_general' );
			
			add_settings_field( 'pyramid_field_copyright', __( 'Use Copyright', 'pyramid' ), array( &$this, 'pyramid_field_copyright_fn' ), 'pyramid_section_general_page', 'pyramid_section_general' );
			add_settings_field( 'pyramid_field_copyright_code', __( 'Enter Copyright Text', 'pyramid' ), array( &$this, 'pyramid_field_copyright_code_fn' ), 'pyramid_section_general_page', 'pyramid_section_general' );
			
			add_settings_field('pyramid_field_reset', __( 'Reset Theme Options', 'pyramid' ), array( &$this, 'pyramid_field_reset_fn' ), 'pyramid_section_general_page', 'pyramid_section_general' );
		
		}
		
		/** Configure default settings. */		
		function settings_default() {
			global $pyramid;
			
			$pyramid_reset = false;
			$pyramid_options = pyramid_get_settings();
			
			/** Pyramid Reset Logic */
			if ( !is_array( $pyramid_options ) ) {			
				$pyramid_reset = true;			
			} 						
			elseif ( $pyramid_options['pyramid_reset'] == 1 ) {			
				$pyramid_reset = true;			
			}			
			
			/** Let Reset Pyramid */
			if( $pyramid_reset == true ) {
				
				$default = array(
					
					'pyramid_post_style' => 'content',
					'pyramid_post_nav_style' => 'numeric',
					
					'pyramid_analytic' => 0,
					'pyramid_analytic_code' => '',
					
					'pyramid_copyright' => 0,
					'pyramid_copyright_code' => '',
					
					'pyramid_reset' => 0,
					
				);
				
				update_option( 'pyramid_options' , $default );
			
			}
		
		}
		
		/** Pyramid Pre-defined Range */
		
		/* Boolean Yes | No */		
		function pyramid_pd_boolean() {			
			return array( 1 => __( 'yes', 'pyramid' ), 0 => __( 'no', 'pyramid' ) );		
		}
		
		/* Post Style Range */		
		function pyramid_pd_post_style() {			
			return array( 'content' => __( 'Content', 'pyramid' ), 'excerpt' => __( 'Excerpt (Magazine Style)', 'pyramid' ) );			
		}
		
		/* Post Navigation Style Range */		
		function pyramid_pd_post_nav_style() {			
			return array( 'numeric' => __( 'Numeric', 'pyramid' ), 'older-newer' => __( 'Older / Newer', 'pyramid' ) );			
		}
		
		/** Pyramid Options Validation */				
		function pyramid_options_validate( $input ) {
			
			/* Validation: pyramid_post_style */
			$pyramid_pd_post_style = $this->pyramid_pd_post_style();
			if ( ! array_key_exists( $input['pyramid_post_style'], $pyramid_pd_post_style ) ) {
				 $input['pyramid_post_style'] = 'excerpt';
			}
			
			/* Validation: pyramid_post_nav_style */
			$pyramid_pd_post_nav_style = $this->pyramid_pd_post_nav_style();
			if ( ! array_key_exists( $input['pyramid_post_nav_style'], $pyramid_pd_post_nav_style ) ) {
				 $input['pyramid_post_nav_style'] = 'numeric';
			}								
			
			/* Validation: pyramid_analytic */
			$pyramid_pd_boolean = $this->pyramid_pd_boolean();
			if ( ! array_key_exists( $input['pyramid_analytic'], $pyramid_pd_boolean ) ) {
				 $input['pyramid_analytic'] = 0;
			}
			
			/* Validation: pyramid_analytic_code */
			if( !empty( $input['pyramid_analytic_code'] ) ) {
				$input['pyramid_analytic_code'] = htmlspecialchars ( $input['pyramid_analytic_code'] );
			}
			
			/* Validation: pyramid_copyright */
			$pyramid_pd_boolean = $this->pyramid_pd_boolean();
			if ( ! array_key_exists( $input['pyramid_copyright'], $pyramid_pd_boolean ) ) {
				 $input['pyramid_copyright'] = 0;
			}
			
			/* Validation: pyramid_copyright_code */
			if( !empty( $input['pyramid_copyright_code'] ) ) {
				$input['pyramid_copyright_code'] = htmlspecialchars ( $input['pyramid_copyright_code'] );
			}
			
			/* Validation: pyramid_reset */
			$pyramid_pd_boolean = $this->pyramid_pd_boolean();
			//if ( ! array_key_exists( pyramid_undefined_index_fix ( $input['pyramid_reset'] ), $pyramid_pd_boolean ) ) {
			if ( ! array_key_exists( $input['pyramid_reset'], $pyramid_pd_boolean ) ) {
				 $input['pyramid_reset'] = 0;
			}
			
			add_settings_error( 'pyramid_options', 'pyramid_options', __( 'Settings Saved.', 'pyramid' ), 'updated' );
			
			return $input;
		
		}
		
		/** Blog Section Callback */				
		function pyramid_section_blog_fn() {}
		
		/* Post Style Callback */		
		function pyramid_field_post_style_fn() {
			
			$pyramid_options = get_option('pyramid_options');
			$items = $this->pyramid_pd_post_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="pyramid_post_style[]" name="pyramid_options[pyramid_post_style]" value="<?php echo $key; ?>" <?php checked( $key, $pyramid_options['pyramid_post_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}		
		
		}
		
		/* Post Style Navigaiton Callback */		
		function pyramid_field_post_nav_style_fn() {
			
			$pyramid_options = get_option('pyramid_options');
			$items = $this->pyramid_pd_post_nav_style();			
			
			foreach( $items as $key => $val ) {
			?>
            <label><input type="radio" id="pyramid_post_nav_style[]" name="pyramid_options[pyramid_post_nav_style]" value="<?php echo $key; ?>" <?php checked( $key, $pyramid_options['pyramid_post_nav_style'] ); ?> /> <?php echo $val; ?></label><br />
            <?php
			}
		
		}
		
		/** General Section Callback */				
		function pyramid_section_general_fn() {}
		
		/* Analytic Callback */		
		function  pyramid_field_analytic_fn() {
			
			$pyramid_options = get_option( 'pyramid_options' );
			$items = $this->pyramid_pd_boolean();
			
			echo '<select id="pyramid_analytic" name="pyramid_options[pyramid_analytic]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $pyramid_options['pyramid_analytic'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to add your Analytic code.', 'pyramid' ) .'</small></div>';
		
		}
		
		function pyramid_field_analytic_code_fn() {
			
			$pyramid_options = get_option('pyramid_options');
			echo '<textarea type="textarea" id="pyramid_analytic_code" name="pyramid_options[pyramid_analytic_code]" rows="7" cols="50">'. htmlspecialchars_decode ( $pyramid_options['pyramid_analytic_code'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the Analytic code.', 'pyramid' ) .'</small></div>';
		
		}
		
		/* Copyright Text Callback */		
		function  pyramid_field_copyright_fn() {
			
			$pyramid_options = get_option( 'pyramid_options' );
			$items = $this->pyramid_pd_boolean();
			
			echo '<select id="pyramid_copyright" name="pyramid_options[pyramid_copyright]">';
			foreach( $items as $key => $val ) {
			?>
            <option value="<?php echo $key; ?>" <?php selected( $key, $pyramid_options['pyramid_copyright'] ); ?>><?php echo $val; ?></option>
            <?php
			}
			echo '</select>';
			echo '<div><small>'. __( 'Select yes to override default Copyright text.', 'pyramid' ) .'</small></div>';
		
		}
		
		function pyramid_field_copyright_code_fn() {
			
			$pyramid_options = get_option('pyramid_options');
			echo '<textarea type="textarea" id="pyramid_copyright_code" name="pyramid_options[pyramid_copyright_code]" rows="7" cols="50">'. esc_html ( $pyramid_options['pyramid_copyright_code'] ) .'</textarea>';
			echo '<div><small>'. __( 'Enter the Copyright Text.', 'pyramid' ) .'</small></div>';
			echo '<div><small>Example: <strong>&amp;copy; Copyright '.date('Y').' - &lt;a href="'. home_url( '/' ) .'"&gt;'. get_bloginfo('name') .'&lt;/a&gt;</strong></small></div>';
		
		}		
		
		/* Theme Reset Callback */		
		function pyramid_field_reset_fn() {
			
			$pyramid_options = get_option('pyramid_options');			
			$items = $this->pyramid_pd_boolean();			
			echo '<label><input type="checkbox" id="pyramid_reset" name="pyramid_options[pyramid_reset]" value="1" /> '. __( 'Reset Theme Options.', 'pyramid' ) .'</label>';
		
		}
}

/** Initiate Admin */
new PyramidAdmin();
?>