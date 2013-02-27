<?php
$sp_themename = "StandardPack";
$sp_shortname = "sp";
$sp_version = "1.8.3.2";

$sp_option_group = $sp_shortname.'_theme_option_group';
$sp_option_name = $sp_shortname.'_theme_options';


// Load stylesheet and jscript
add_action('admin_enqueue_scripts', 'sp_add_init');

function sp_add_init( $hook_suffix) {
	if ( $hook_suffix == 'appearance_page_theme-options' ) {
		$file_dir = get_template_directory_uri();
		wp_enqueue_style("spCss", $file_dir."/functions/theme-options.css", false, "1.0", "all");
		wp_enqueue_script("spScript", $file_dir."/functions/theme-options.js", false, "1.0");
	}
}

// Create custom settings menu
add_action('admin_menu', 'sp_create_menu');

function sp_create_menu() {
	global $sp_themename;
	//create new top-level menu
	add_theme_page( __( $sp_themename.' Theme Options' ), __( 'Theme Options', 'standardpack'), 'edit_theme_options', basename(__FILE__), 'sp_settings_page' );
}

// Register settings
add_action( 'admin_init', 'register_settings' );

function register_settings() {
   global $sp_themename, $sp_shortname, $sp_version, $sp_settings, $sp_option_group, $sp_option_name;
  	//register our settings
	register_setting( $sp_option_group, $sp_option_name , 'sp_theme_options_validate');
}

// Create theme options
global $sp_settings;
$sp_settings = array (

array("name" => __('General', 'standardpack'),
		"type" => "section"),
		
array("name" => __('Set up basic settings','standardpack'),
		"type" => "section-desc"),
	
array("type" => "open"),

array( "name" => __('Logo URL', 'standardpack'),
	"desc" => __('Enter the link to your logo image. (390x50 pixel)', 'standardpack'),
	'id' => 'logo',
	'type' => 'text',
	'std' => ''),	

array( "name" => __('Tag Line', 'standardpack'),
	"desc" => __('Check this box to hide tag line', 'standardpack'),
	"id" => "hide_tag",
	'type' => 'checkbox',
	'std' => ''),
	
array( "name" => __('Hide Page Comments', 'standardpack'),
	"desc" => __('Check this box to disable comments in Page posts', 'standardpack'),
	'id' => 'page_comments',
	'type' => 'checkbox',
	'std' => ''),

array( "name" => __('Custom Favicon', 'standardpack'),
	"desc" => __('A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image', 'standardpack'),
	'id' => 'favicon',
	'type' => 'text',
	'std' => home_url() ."/favicon.ico"),
	
array( "name" => __('Google Analytics Code', 'standardpack'),
	"desc" => __('Note: Google Analytics script goes in the &lt;head&gt; element to better support the new asynchronous Google Analytics script. Please make sure you update your script to use the new asynchronous script from Google Analytics. <b>Do Not Use</b> &lt;script&gt; tags.', 'standardpack'),
	'id' => "ga_code",
	'type' => "textarea",
	"std" => ''),
	
array( "name" => __('Footer copyright text', 'standardpack'),
	"desc" => __('Enter text used in the right side of the footer. It can be HTML:  &lt;a href=&lsquo; &rsquo; title=&lsquo; &rsquo;&gt; ', 'standardpack'),
	'id' => 'footer_text',
	'type' => 'text',
	'std' => ''),
	
array("type" => "close"),

//Social Links
array("name" => __('Socials Buttons', 'standardpack'),
		"type" => "section"),
		
array("name" => __('Facebook, Feeds and Twitter','standardpack'),
		"type" => "section-desc"),
	
array("type" =>"open"),

array( "name" => __('Feedburner URL', 'standardpack'),
	"desc" => __('Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website', 'standardpack'),
	'id' => 'feedburner',
	'type' => 'text',
	'std' => get_bloginfo('rss2_url')),
	
array( "name" => __('Facebook URL', 'standardpack'),
	"desc" => __('Paste your Fackebook URL here (with http://). Leave it blank for display none', 'standardpack'),
	'id' => 'facebook',
	'type' => 'text',
	'std' => ''),	
	
array( "name" => __('Twitter URL', 'standardpack'),
	"desc" => __('Paste your Twitter URL here (with http://). Leave it blank for display none', 'standardpack'),
	'id' => 'twitter',
	'type' => 'text',
	'std' => ''),

array( "type" => "close"),


);


function sp_settings_page() {
   global $sp_themename, $sp_shortname, $sp_version, $sp_settings, $sp_option_group, $sp_option_name;
?>

<div class="wrap">
<?php screen_icon(); ?><h2><?php echo $sp_themename; ?> <?php _e('Theme Options','standardpack'); ?></h2>
<p class="top-notice"><?php _e('To easily customize your WordPress Blog, you can use the settings below. ','standardpack'); ?></p>
<div class="options_wrap">
<?php if ( isset ( $_POST['reset'] ) ): ?>
<?php // Delete Settings
global $wpdb, $sp_themename, $sp_shortname, $sp_version, $sp_settings, $sp_option_group, $sp_option_name;
delete_option('sp_theme_options');
wp_cache_flush(); ?>
<div class="updated fade"><p><strong><?php _e( $sp_themename. ' options reset.' ); ?></strong></p></div>

<?php elseif ( isset ( $_REQUEST['settings-updated'] ) ): ?>
<div class="updated fade"><p><strong><?php _e( $sp_themename. ' options saved.' ); ?></strong></p></div>
<?php endif; ?>

<form method="post" action="options.php">

<?php settings_fields( $sp_option_group ); ?>

<?php $sp_options = get_option( $sp_option_name ); ?>        

<?php foreach ($sp_settings as $value) {
if ( isset($value['id']) ) { $valueid = $value['id'];}
switch ( $value['type'] ) {
case "section":
?>
	<div class="section_wrap">
	<h3 class="section_title"><?php echo $value['name']; ?> 

<?php break; 
case "section-desc":
?>
	<span><?php echo $value['name']; ?></span></h3>
	<div class="section_body">

<?php 
break;
case 'text':
?>

	<div class="options_input options_text">
		<div class="options_desc"><?php echo $value['desc']; ?></div>
		<span class="labels"><label for="<?php echo $sp_option_name.'['.$valueid.']'; ?>"><?php echo $value['name']; ?></label></span>
		<input name="<?php echo $sp_option_name.'['.$valueid.']'; ?>" id="<?php echo $sp_option_name.'['.$valueid.']'; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( isset( $sp_options[$valueid]) ){ esc_attr_e( stripslashes($sp_options[$valueid])); } else { esc_attr_e( stripslashes($value['std'])); } ?>" />
	</div>

<?php
break;
case 'textarea':
?>
	<div class="options_input options_textarea">
		<div class="options_desc"><?php echo $value['desc']; ?></div>
		<span class="labels"><label for="<?php echo $sp_option_name.'['.$valueid.']'; ?>"><?php echo $value['name']; ?></label></span>
		<textarea name="<?php echo $sp_option_name.'['.$valueid.']'; ?>" type="<?php echo $sp_option_name.'['.$valueid.']'; ?>" cols="" rows=""><?php if ( isset( $sp_options[$valueid]) ){ esc_attr_e( stripslashes($sp_options[$valueid])); } ?></textarea>
	</div>

<?php 
break;
case 'select':
?>
	<div class="options_input options_select">
		<div class="options_desc"><?php echo $value['desc']; ?></div>
		<span class="labels"><label for="<?php echo $sp_option_name.'['.$valueid.']'; ?>"><?php echo $value['name']; ?></label></span>
		<select name="<?php echo $sp_option_name.'['.$valueid.']'; ?>" id="<?php echo $sp_option_name.'['.$valueid.']'; ?>">
		<?php foreach ($value['value'] as $option) { ?>
				<option<?php selected($sp_options[$valueid] == $option ) ?>><?php echo $option; ?></option>
		<?php } ?>		
		</select>
	</div>

<?php
break;
case "radio":
?>
	<div class="options_input options_select">
		<div class="options_desc"><?php echo $value['desc']; ?></div>
		<span class="labels"><label for="<?php echo $sp_option_name.'['.$valueid.']'; ?>"><?php echo $value['name']; ?></label></span>
		  <?php foreach ($value['options'] as $key=>$option) { 
			$radio_setting = $sp_options[$valueid];
			if($radio_setting != ''){
				if ($key == $sp_options[$valueid] ) {
					checked($sp_options[$valueid]);
					}
			}else{
				if($key == $value['std']){
					checked($sp_options[$valueid]);
				}
			}?>
			<input type="radio" id="<?php echo $sp_option_name.'['.$valueid.']'; ?>" name="<?php echo $sp_option_name.'['.$valueid.']'; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
			<?php } ?>
	</div>

<?php
break;
case "checkbox":
?>
	<div class="options_input options_checkbox">
		<div class="options_desc"><?php echo $value['desc']; ?></div>

		<input type="checkbox" name="<?php echo $sp_option_name.'['.$valueid.']'; ?>" id="<?php echo $sp_option_name.'['.$valueid.']'; ?>" value="1" <?php if( isset( $sp_options[$valueid] ) ){checked($sp_options[$valueid]);} ?> />
		<label for="<?php echo $sp_option_name.'['.$valueid.']'; ?>"><?php echo $value['name']; ?></label>
	 </div>

<?php
break;
case "close":
?>
</div><!--#section_body-->
</div><!--#section_wrap-->

<?php 
break;
}
}
?>

<span class="submit">
<input class="button button-primary" type="submit" name="save" value="<?php _e('Save All Changes', 'standardpack') ?>" />
</span>
</form>

<form method="post" action="">
<span class="button-right" class="submit">
<input class="button button-secondary" type="submit" name="reset" value="<?php _e('Reset/Delete Settings', 'standardpack') ?>" />
<input type="hidden" name="action" value="reset" />
<span><?php _e('Caution: All entries will be deleted from database. Press when starting afresh or completely removing the theme.','standardpack') ?></span>
</span>
</form>
</div><!--#options-wrap-->

<div class="postbox-container">
	<div class="metabox-holder">
		<div class="widget-liquid-right">
			<div id="widgets-right">
				<div id="side-sortables" class="meta-box-sortables">

				<div id="about" class="postbox">
					<h3 class="hndle" id="about-sidebar"><?php _e('About','standardpack') ?> <?php echo $sp_themename; ?>:</h3>
					<div class="inside">
						<p><?php _e('You are using','standardpack') ?> <strong><?php echo $sp_themename; ?> <?php echo $sp_version; ?></strong><br />
							<a target="_blank" href="http://tutskid.com/standardpack/"><?php _e('Theme Homepage','standardpack') ?></a></p>
						<p><strong><?php _e('WordPress Theme by','standardpack') ?>:</strong><br />				
							<a target="_blank" href="http://tutskid.com/"><?php _e('TutsKid','standardpack') ?></a></p>
						</div><!-- .inside -->
					</div><!-- #about.postbox -->

			<div id="about" class="postbox">
				<h3 class="hndle" id="about-sidebar"><?php _e('Donate','standardpack') ?>:</h3>
				<div class="inside">
					<p><?php _e('Like the Theme? Please consider buying me a cup of coffee. Thank you','standardpack') ?>!<br />
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="HLVJB7KTJSZRA">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form></p>
				</div><!-- .inside -->
			</div><!-- #about.postbox -->
			
				</div><!-- #side-sortables.meta-box-sortables -->
			</div><!-- .widgets-right -->
		</div><!-- .widget-liquid-right -->
	</div><!-- .metabox-holder -->
</div><!-- .postbox-container -->

<?php } 

	// validates the theme's options upon submission.
	function sp_theme_options_validate( $input ) {
		global $sp_settings;
		foreach ( $sp_settings as $value ) {
			switch ( $value['type'] ) {
				case 'select':
					$input[$value['id']] = wp_filter_nohtml_kses( $input[$value['id']] );
					break;
				case 'text':
					$input[$value['id']] = wp_filter_post_kses( $input[$value['id']] );
					break;
				case 'textarea':
					$input[$value['id']] = wp_filter_post_kses( $input[$value['id']] );
					break;
			}
		}
		return $input;
	} 

?>