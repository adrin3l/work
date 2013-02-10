<?php
/*
Plugin Name: VMH Helper Plugin
Description: functions used in other plugins
Version: 1.1
Author: bo lipai
Author URI: http://thennp.wordpress.com

*/  


function is_nnp(){
	
	/*if( is_admin() ){
		global $nnpmcs_content_site;
		//var_dump_pre(is_plugin_active('nnp-multisite-content-sharing/nnp-multisite-content-sharing.php')); 
		var_dump_pre($nnpmcs_content_site);
		var_dump_pre(get_option( 'active_plugins' ), 'get_option( active_plugins )');
		var_dump_pre( in_array( 'nnp-multisite-content-sharing/nnp-multisite-content-sharing.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))); 
		var_dump_pre(is_admin(),'is_admin'); 
		if(in_array( 'nnp-multisite-content-sharing/nnp-multisite-content-sharing.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )){
		//if( is_plugin_active('nnp-multisite-content-sharing/nnp-multisite-content-sharing.php' )) {
			return TRUE;
		}
	}
	else{
		if( defined( 'IS_NNP' )){
			return TRUE;
		}	
	}*/
	if( defined( 'IS_NNP' )){
			return TRUE;
		}	
	return FALSE;
}

/*
 * name:read_xml_ads
 * description: reads the data from adsadmin xml
 * returns: array
 * 
 * */
 class read_xml_ads{


	function read_xml_ads(){

		return true;
	}

	function return_array( $xmlUrl = '', $context = '' ){

		if($xmlUrl == '') 
			return false;

		//$xmlUrl = "http://adsadmin.informmedia.ro/exportedads/tion.xml"; // XML feed file/URL
		if( $context == '')
			$xmlStr = file_get_contents( $xmlUrl );
		else
			if( ! $xmlStr = @file_get_contents( $xmlUrl, 0, $context ))
				return false;
				
		$xmlObj = simplexml_load_string($xmlStr);
		$arrXml = $this->objectsIntoArray($xmlObj);

		return 	$arrXml['ad'];
	}

	function objectsIntoArray($arrObjData, $arrSkipIndices = array()){
	    
	    $arrData = array();
	   
	    // if input is object, convert into array
	    if (is_object($arrObjData)) {
		$arrObjData = get_object_vars($arrObjData);
	    }
	   
	    if (is_array($arrObjData)) {
			foreach ($arrObjData as $index => $value) {
				if (is_object($value) || is_array($value)) {
					$value = $this->objectsIntoArray($value, $arrSkipIndices); // recursive call
				}
				if (in_array($index, $arrSkipIndices)) {
					continue;
				}
				$arrData[$index] = $value;
			}
	    }
	    return $arrData;
	}


}//end class

/*
 * name: var_dump_pre
 * description: formated var_dump
 * 
 * */
function var_dump_pre( $var, $title='', $color = 'white', $dump = FALSE ){
	?>

	<?php
	$style = 'clear:both;overflow:auto;border:1px solid #BFBFBF; margin-top:10px; padding-left:3px;padding-bottom:3px;background-color:'.$color;
	echo '<div class="debug" style="'. $style .'" >';
	$db = debug_backtrace();
	//echo 'function: '.$db[0]['file'].' @ line:['.$db[0]['line'].']';
	$file  = strrev(implode(strrev(' /<span style="color:black">'), explode("/", strrev($db[0]['file']), 2)));
	$file .= '</span>'; 
	echo '<div style="width:100%; margin-left:-3px; color:#969696;background-color:#F0F0F0;padding:3px 0px 3px 3px"><small><span style="color:black">file: </span>'.$file.' <br />@<br /><span style="color:black">line:['.$db[0]['line'].']</span></small></div>';
	echo '<pre>';

	if( $title !='' )
		echo '<div style="width:100%; margin-left:-3px; background-color:#E5E5F8;padding:3px 0px 3px 3px"><strong>'.$title.':</strong></div><br />';
	
	if( $dump || is_bool( $var )){
		if( is_bool( $var )){
					
			switch ( $var ){
				case TRUE:
					echo '<span style="color:green">'; var_dump( $var ); echo '</span>';
				break;
				
				case FALSE:
					echo '<span style="color:red">'; var_dump( $var );echo '</span>';
				break;
			}
		}
		else
			var_dump( $var );
	}
	else
		print_r( $var );
	echo '</pre>';
	echo '</div>';
	echo '<div style="clear:both"></div>';
}

function var_dump_html( $vars, $title  = 'none'){
	
	$html_comment = '';
	$html_comment .= '<!-- ';
	$db = debug_backtrace();
	$html_comment .= 'function: '.$db[0]['file'].' @ line:['.$db[0]['line'].'] -> ';
	
	if( is_array( $vars )){
		
		foreach( $vars as $key => $val ){
			$html_comment .= $key.':'.$val.' - ';
		}
	}
	else{
		$html_comment .= $vars;
	}
	$html_comment .= ' [title: '. $title . '] -->';
	
	echo $html_comment;
}

/**
* name: stringProcess
* description: usefull string process class
* 
* @param string $string Input string
*
* @return string
*/	
class stringProcess {
	
	
	function stringProcess(){
		// $a - needle 1
		// $b - needle 2
		// $d - just in case... replace_between
		// $c - haystack
	}

	function starts_with( $a, $c ) {
		return substr( $a, 0, strlen( $c )) == $c;
	}
		
    function after ($a, $c){
        if ( !is_bool( strpos( $c, $a )))
        return substr( $c, strpos( $c,$a ) + strlen( $a ));
    }

    function after_last ($a, $c){
        if (!is_bool($this -> strrevpos($c, $a)))
        return substr($c, $this -> strrevpos($c, $a)+strlen($a));
    }

    function before ($a, $c)
    {
        return substr($c, 0, strpos($c, $a));
    }

    function before_last ($a, $c)
    {
        return substr($c, 0, $this -> strrevpos($c, $a));
    }

    function between ($a, $b, $c)
    {
		// if $a == $b
		if ( $a == $b ){
			
			$c = $this -> after ( $a, $c );
			return $this -> before( $b, $c );
		}
		return $this -> before($b, $this -> after($a, $c));
    }
    
    function remove_between ($a, $b, $c)
    {
		// if $a == $b
		if ( $a == $b ){
				
			return false;
		}
		//return $this -> before($a, $c).$this -> after($b, $c);
		return false;
		
    }
    
    function replace_between ($a, $b, $d, $c)
    {
		// if $a == $b
		if ( $a == $b ){
			
			return $c;
		}
		return $this -> before($a, $c).$this -> after($b, $c);
		
    }

    function between_last ($a, $b, $c)
    {
     return $this -> after_last($a, $this -> before_last($b, $c));
    }


    function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    } 

	function multi_between($a, $b, $c){
		$counter = 0;
		
		if ( $a == $b ){
			while ( $c ){
				//echo '<br />c before: '.$c;
				$c = $this -> after ( $a, $c );
				//echo '<br />c after: '.$c;
				$elements[$counter] = $this -> before( $b, $c );
				//echo '<br />el: '.$elements[$counter] ;
				$c = $this -> after( $b, $c );
				//echo '<br />c exit: '.$c;
				$counter++;
			}
		}
		else
		while ( $c ){
			
			$elements[$counter] = $this -> before($b, $c);
			//echo '<br />1: '.$elements[$counter];
			//echo '<br />a: '.$a;
			$elements[$counter] = $this -> after($a, $elements[$counter]);
			//echo '<br />2:'.$elements[$counter];
			$c = $this -> after($b, $c);
			//echo '<br />c: '.$c;
			$counter++;
		}
		if ( $elements[0] === false ) return false;
		
		return $elements;
	}
	
	function add_http( $a ) {
		
		if( !isset( $a )){
			return '';
		}
		
		if( empty( $a )){
			return '';
		}
		
	 	if ( $this -> starts_with( $a, 'http://' )){
			return $a;
		}
		else{
			return 'http://' . $a;
		}
	}	 
/*
 * after ('@', 'biohazard@online.ge');
 returns 'online.ge'
 from the first occurrence of '@'

 before ('@', 'biohazard@online.ge');
 returns 'biohazard'
 from the first occurrence of '@'

 between ('@', '.', 'biohazard@online.ge');
 returns 'online'
 from the first occurrence of '@'

 after_last ('[', 'sin[90]*cos[180]');
 returns '180]'
 from the last occurrence of '['

 before_last ('[', 'sin[90]*cos[180]');
 returns 'sin[90]*cos['
 from the last occurrence of '['

 between_last ('[', ']', 'sin[90]*cos[180]');
 returns '180'
 from the last occurrence of '[' 
 * */
}//endclass

/*
 * name: nnp_get_submenus
 * description: generate the submenus for nnp
 */
function nnp_get_submenus(){
		
		global $menu, $submenu; 
				
		$menus = $submenu['vmh_general_settings.php'];
		$menus = !empty($menus) ? $menus : $submenu['nnp_general_settings.php'];
		
		echo '<ul class="nnp_general_settings_menu">';
		
		foreach( $menus as $temp ){
			
			?>
				<li>
					<a href="<?php echo get_bloginfo('url').'/wp-admin/admin.php?page='.$temp[2]; ?>" >
						<?php echo $temp['0']; ?>
					</a>
				</li>
			<?php
		}
		echo '</ul>';
		echo '<div class="clear"></div>';
	}


/*
 * 
 * */
function get_current_url(){
	
	$pageURL = 'http';
	
	if( isset( $_SERVER["HTTPS"] ))
		if ( $_SERVER["HTTPS"] == "on" ){
			$pageURL .= "s";
		}
	$pageURL .= "://";

	if ($_SERVER["SERVER_PORT"] != "80") {
		
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["PHP_SELF"];
	} 
	else {
		
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
	}
	
	return $pageURL;
}

/*
 * 
 * */

function get_current_url_page(){

	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
 

}

function get_domain( $url ) {
	$pieces = parse_url( $url );
	$domain = isset( $pieces['host'] ) ? $pieces['host'] : '';
	if ( preg_match( '/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,5})$/i', $domain, $regs ) ) {
		return $regs['domain'];
	}
	return str_ireplace( 'www.', '', $pieces );
}

class vmh_widgets_form {
		
		var $_used_inputs = array();
		var $_options = array();
		var $_args = array();
		var $_var = '';
		var $_used_inputs_printed = false;
		

	function vmh_widgets_form( $options = array(), $args = array() ) {
			$new_options = array();
			
			foreach ( (array) $options as $var => $val ) {
				if ( is_array( $val ) )
					continue;
				
				$new_options[$var] = $val;
			}
			
			if ( ! empty( $args['defaults'] ) && is_array( $args['defaults'] ) ) {
				foreach ( (array) $args['defaults'] as $var => $val )
					$new_options["default_option_$var"] = $val;
			}
			
			$options = $new_options;
			
			$this->_args =& $args;
			$this->_options =& $options;
		}
	/*
	 * name:
	 * description:
	 * 
	 * */	

	function add_text_box( $name, $label='', $value = FALSE ) {
		
			$defaults = array();
			
			if ( isset( $this->_args['widget_instance'] ) && @method_exists( $this->_args['widget_instance'], 'get_field_name' ) )
				$defaults['name'] = $this->_args['widget_instance']->get_field_name( $name );
			else if ( empty( $this->_args['prefix'] ) )
				$defaults['name'] = $name;
			else
				$defaults['name'] = "{$this->_args['prefix']}-$name";	
			//var_dump_pre( $defaults['name'], 'defa name' );
			//global $suspect;
				
			//var_dump_pre( $this->_options, 'arg' );
					
	?>
		<p>
			<label for="<?php echo $defaults['name']; ?>">
				<?php 
					if( !empty($label))
						_e( $label );
					else
						_e( $name );
				?>
			</label>
			<input type="text" id="<?php echo $defaults['name']; ?>" name = "<?php echo $defaults['name']; ?>"  value="<?php if(( FALSE === $value ) || empty( $value )) echo $this->_options[$name];else echo $value ?>" />
		</p>

	<?php 
	}
	
	/*
	 * name:
	 * description:
	 * 
	 * */	

	function add_hidden_field( $name, $value ) {
		
		$defaults = array();
		
		if ( isset( $this->_args['widget_instance'] ) && @method_exists( $this->_args['widget_instance'], 'get_field_name' ) )
			$defaults['name'] = $this->_args['widget_instance']->get_field_name( $name );
		else if ( empty( $this->_args['prefix'] ) )
			$defaults['name'] = $name;
		else
			$defaults['name'] = "{$this->_args['prefix']}-$name";	
		//var_dump_pre( $defaults['name'], 'defa name' );
		//global $suspect;
			
		//var_dump_pre( $this->_options, 'arg' );
				
	?>
		<input type="hidden" id="<?php echo $defaults['name']; ?>" name = "<?php echo $defaults['name']; ?>"  value="<?php echo $value; ?>" />
		

	<?php 
	}
	function add_radio_box( $name, $elements ){
		$defaults = array();
			
		if ( isset( $this->_args['widget_instance'] ) && @method_exists( $this->_args['widget_instance'], 'get_field_name' ) )
			$defaults['name'] = $this->_args['widget_instance']->get_field_name( $name );
		else if ( empty( $this->_args['prefix'] ) )
			$defaults['name'] = $name;
		else
			$defaults['name'] = "{$this->_args['prefix']}-$name";	
			
		//var_dump_pre($elements);			
	
	?>
		<div style="height:150px;overflow:auto;width:440px;border:1px solid #efefef;padding:3px">
			<?php
				foreach ( $elements as $cpost ) {
			?>
					<input type="radio" id="<?php echo $defaults['name']; ?>"  value="<?php echo $cpost->ID;?>" name= "<?php echo $defaults['name']; ?>" <?php if( $this->_options[$name] == $cpost->ID ) echo ' checked ';?>>
					<?php echo $cpost->post_title . '  (post id: ' . $cpost->ID.' )';?>
					<br />
				
			<?php 
				}
			?>
	    </div>
	<?php
	}
	
	function add_text_area( $name, $label='') {
		
			$defaults = array();
			
			if ( isset( $this->_args['widget_instance'] ) && @method_exists( $this->_args['widget_instance'], 'get_field_name' ) )
				$defaults['name'] = $this->_args['widget_instance']->get_field_name( $name );
			else if ( empty( $this->_args['prefix'] ) )
				$defaults['name'] = $name;
			else
				$defaults['name'] = "{$this->_args['prefix']}-$name";	
						
			
	?>
		<p>
			<label for="<?php echo $defaults['name']; ?>">
				<?php 
					if(!empty($label))
						_e( $label );
					else
						_e( $name );
				?>
			</label><br />
			<textarea rows="7" cols="20" id="<?php echo $defaults['name']; ?>" name = "<?php echo $defaults['name']; ?>"><?php echo trim($this->_options[$name]); ?>
			</textarea>
		</p>

	<?php 
	}


}

function vmh_get_plugin_path( $file ) {
    return WP_PLUGIN_DIR . '/'. str_replace( basename( $file) , '', plugin_basename( $file ) );
}

function vmh_get_plugin_url( $file ) {
    return WP_PLUGIN_URL . '/'. str_replace( basename( $file) , '', plugin_basename( $file ) );
}

/*
 * name:nnp_get_site_langcode
 * description: returns the language code for the current network
 * */
function nnp_get_site_langcode(){
	
	global $blog_id;
	
	$lang = get_blog_option( $blog_id, 'WPLANG' ); 
	$lang =  explode( '_', $lang );
	return $lang[0];
}


/*
 * name:decode_utf8
 * description: transforms special characters to coresponding ones
 * */

function decode_utf8($string) {

	$search = array("\xC4\x82", "\xC4\x83", "\xC3\x82", "\xC3\xA2", "\xC3\x8E", "\xC3\xAE", "\xC8\x98", "\xC8\x99", "\xC8\x9A", "\xC8\x9B", "\xC5\x9E", "\xC5\x9F", "\xC5\xA2", "\xC5\xA3");

	$replace = array("A", "a", "A", "a", "I", "i", "S", "s", "T", "t", "S", "s", "T", "t"); 

	return str_replace($search, $replace, $string); 
}

/*
 * get the template name (debug function) 
 */

function get_template_name() {
	foreach ( debug_backtrace() as $called_file ) {
		foreach ( $called_file as $index ) {
			if ( !is_array($index[0]) AND strstr($index[0],'/themes/') AND !strstr($index[0],'footer.php') ) {
				$template_file = $index[0] ;
			}
		}
	}
	
	$template_contents = file_get_contents($template_file) ;
	preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
	$template_name = trim($template_name[1][0]);
	
	if ( !$template_name ){ 
		$template_name = '(default)' ; 
	}
	$template_file = array_pop(explode('/themes/', basename($template_file)));
	
	return $template_file . ' > '. $template_name ;
}

/**********************************************************************
 * 
 * sso functions
 * 
 * *******************************************************************/

	/*
	 * name: sso_login
	 * description: tries to login into sso with credentials set by $param
	 * return: 	on success 	-> (obj) sso $user object
	 * 			on fail 	-> (string) the error message
	 * */
	function sso_login( $param ){

		global $sso;
		
		$res = $sso -> login($param);
		
		if( FALSE === $res ){
			return FALSE;
		}
		
		if ( (bool) $res -> success )
			//return TRUE;
			return $res;
		else{
			return $res->error_text;
			//return $res->error;
		}
		
		
		
	}
	/*
	 * name: sso_logout
	 * description: tries to login into sso with credentials set by $param
	 * return: 	on success 	-> (obj) sso $user object
	 * 			on fail 	-> (string) the error message
	 * */
	
	function sso_logout( $param ){

		global $sso;
		
		$res = $sso->logout( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( (bool) $res -> success ){
			//return TRUE;
			return $res;
		}
		else{
			
			return $res->error_text;
		}
		
	}
	/*
	 * name: sso_change_user_data
	 * description: change user data
	 * return: 	on success 	-> (obj) sso $user object
	 * 			on fail 	-> (string) the error message
	 * */
	function sso_change_user_data( $param ){
		global $sso;
			
		$res = $sso->ChangeUserData( $param );
		//return $res;
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( (bool) $res -> success ){
			
			return TRUE;
		}
		else{
			
			return $res->error_text;
		}
		
	}
	/*
	 * name: sso_change_user_pass
	 * description: tries to login into sso with credentials set by $param
	 * return: 	on success 	-> (obj) sso $user object
	 * 			on fail 	-> (string) the error message
	 * */
	function sso_change_user_pass( $param ){
		global $sso;
			
		$res = $sso->ChangePassword( $param );
		//return $res;
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( (bool) $res -> success ){
			
			return TRUE;
		}
		else{
			
			return $res->error_text;
		}
		
	}
	
	/*
	 * name: sso_check_login_exists_err_no
	 * description: check if email exists in sso
	 * returns: TRUE is the email does NOT exists
	 * 
	 * */
	function sso_check_login_exists_err_no( $param ){
		//validate_username @ registration
		global $sso, $sso_client_title, $sso_client;
		
		$res = $sso -> CheckLogin( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
			
			return $res->error;
		}
	}
	/*
	 * name: sso_check_login_exists
	 * description: check if email exists in sso
	 * returns: TRUE is the email does NOT exists
	 * 
	 * */
	function sso_check_login_exists( $param ){
		//validate_username @ registration
		global $sso, $sso_client_title, $sso_client;
		
		$res = $sso -> CheckLogin( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
			
			return $res->error_text;
		}
	}
	/*
	 * name: sso_verify
	 * description: checks if the entered password matches the password lodged in 
	 * 				the SSO for the indicated user name.
 	 * returns: TRUE if the url was ok  or error text
	 * 
	 * */
	function sso_verify( $param ){
		 
		global $sso, $sso_client_title, $sso_client;
	
		$res = $sso -> Verify( $param );
		//return ($res);
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
						
			return $res->error_text;
		}

		
	}
	
	/*
	 * name: sso_send_forgot_pass_email
	 * description: sends email if the user requested lost password
	 * returns: TRUE if the email was sent or error text
	 * 
	 * */
	function sso_send_forgot_pass_email( $param ){
		 
		global $sso, $sso_client_title, $sso_client;
			
		$res = $sso->ForgetPassword( $param );
		
		if( FALSE === $res )		
			return FALSE;
		
		if ( (bool) $res -> success ){
			return TRUE;
		}
		else{
			
			return $res -> error_text;
			
		}
	}
	
	/*
	 * name: sso_validate_email_link
	 * description: validates the url sent by sso to verify the user email 
	 * returns: TRUE if the url was ok  or error text
	 * 
	 * */
	function sso_validate_email_link( $param ){
		 
		global $sso, $sso_client_title, $sso_client;
	
		$res = $sso -> ValidateEmailLink( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
						
			return $res->error_text;
		}

		
	}
	
	/*
	 * name: sso_validate_forget_password
	 * description: 
	 * returns: TRUE if the url was ok  or error text
	 * 
	 * */
	function sso_validate_forget_password( $param ){
		global $sso, $sso_client_title, $sso_client;
	
		$res = $sso -> ValidateForgetPassword( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
			
			return $res->error_text;
		}

		
	}
	
	/*
	 * name: sso_get_email_validation_param
	 * description: 
	 * returns: FALSE if something is missing from the validation link ( the link is invalid )
	 * 			or array of link items	
	 * 
	 * */
	function sso_get_email_validation_param( $key ){
		
		global $sso, $sso_client_title, $sso_client;
		
		$temp = explode( '_', $key );
		$param['email_hash']		= trim($temp[0]);
		$param['sso_client']		= trim($temp[1]);
		$param['client_title']		= trim($temp[2]);
		
		//var_dump_pre( $param, 'params in sso_get_email_validation_param:['.__FILE__.']['.__LINE__.']');		
		
		// check if params are ok
		if( ( $param['email_hash'] == '' ) || ( $param['client_title'] == '' ) || ( $param['sso_client'] == '' ))
			return FALSE;
		else 
			return $param; 
	
	}
	
	/*
	* name: sso_get_all_data_by_email
	* description: 
	* return
	* */
	function sso_get_all_data_by_email ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
        
        $res = $sso->GetAllDataByEmail( $param );
        
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return $res;
		}
		else{
			
			return $res->error_text;
		}
        

	}
	/*
	* name: sso_get_all_data_by_login
	* description: 
	* return
	* */
	function sso_get_all_data_by_login ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
        
        $res = $sso->GetAllDataByLogin( $param );
                
        return $res;
        

	}
	
	/*
	* name: sso_get_all_data_by_oAuthId
	* description: 
	* return
	* */
	function sso_get_all_data_by_oauth_id ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
        
        $res = $sso -> GetAllDataByOauth( $param );
		
        if ( $res -> success ){
			return $res;
		}
		
		return FALSE;
	}
	
	/*
	* name: sso_get_all_data_by_oauth_id_and_alias
	* description: 
	* return
	* */
	function sso_get_all_data_by_oauth_id_and_alias ( $param ) {
		
		global $sso, $config;
        
        $res = $sso -> GetAllDataByOauth( $param );
		
        if ( $res -> success ){
			
			$alias = 'alias'.$config['sso_portal_alias'].'_name';
			//check if he has alias set
			if( !empty( $res -> $alias )){
				return $res -> $alias;
			}
		}	
		return FALSE;
	}
	
	/*
	* name: sso_get  getOauthConfiguration
	* description: 
	* return
	* */
	function sso_get_oauth_configuration ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
        
        $res = $sso ->  getOauthConfiguration( $param );
                
        return $res;
        

	}
	
	/*
	* name: sso_get__data
	* description: return user data based on hash and token
	* returns error if hash and token are not good
	* param: hash & token
	* */
	function sso_get_data ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
                
		//$param['client'] = $sso_client;
        //$param['client_title'] = $sso_client_title;	
        
        //var_dump_pre($param,'param['.__LINE__.']');
        
        $res = $sso -> GetData( $param );
            
        return $res;
        

	}
	
	/*
	* name: sso_get_all_data
	* description: check if email exists in sso
	* param: hash & token
	* */
	function sso_get_all_data ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
                
		$param['client'] = $sso_client;
        $param['client_title'] = $sso_client_title;	
        
        //var_dump_pre($param,'param['.__LINE__.']');
        
        $out = $sso -> GetDataAll( $param );
            
        return $out;
        

	}

	/*
	* name: sso_new_validation_mail
	* description: 
	* return: 
	* */
	function sso_new_validation_mail ( $param ) {
		
		global $sso, $sso_client_title, $sso_client;
                
        //$asd['email'] = "asd1024@mailinator.com";
        
      
        $res = $sso -> NewValidationMail( $param );
		
		if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
						
			return $res->error_text;
		}

        

	}

	/*
	* name: sso_register_user
	* description: 
	* return: 
	* */
	function sso_register_user( $param ) {
		
		global $sso, $sso_client_title, $sso_client;

        $res = $sso->register( $param );
        //var_dump ( $res );
        
        if( FALSE === $res )		
			return FALSE;
			
		if ( $res -> success ){
			return TRUE;
		}
		else{
			
			return $res->error_text;
		}

  }
  
  	/*
	 * name: sso_get_user_attribute
	 * description: get user attributes
	 * returns: if $attr is TRUE the returned value will be the attribute value
	 * 			else the returned value will be all atributes
	 * */
	function sso_get_user_attribute( $param, $attr = FALSE ){
		 
		global $sso, $sso_client_title, $sso_client;
			
		$res = $sso->GetUserAttributes( $param );
		
		if( FALSE === $res )		
			return FALSE;
		
		if ( (bool) $res -> success ){
			//var_dump_pre( $res );
			if( $attr ){
				$attr_arr=jquery_serialized2array($res->attributes, ',');
				$key = array_key_is( $attr_arr, $attr );
				if( FALSE !== $key ){
					return $key;
				}
				else{
					//return 'user attribute does not exists';
					return 2;
				}
			}
			else{
				return	$res->attributes;
			}
		}
		else{
			
			return $res -> error_text;
			
		}
	}

  	/*
	 * name: sso_set_user_attribute
	 * description: set user attributes
	 * returns: TRUE if the email was sent or error text
	 * 
	 * */
	function sso_set_user_attribute( $param ){
		 
		global $sso, $sso_client_title, $sso_client;
			
		$res = $sso->SetUserAttribute( $param );
		//var_dump_pre($res);
		//var_dump_pre($param);
		if( FALSE === $res )		
			return FALSE;
		
		if ( (bool) $res -> success ){
			return TRUE;
		}
		else{
			
			return $res -> error_text;
			
		}
	}

  	
	/************************************************************
	 * cookies
	 *************************************************************/
	
	/*
	* name:  sso_set_cookie
	* description: set the sso cookie
	* param: login - (array) (email, token, hash )
	* */
	function sso_set_cookie( $login ){
		
		global $cookie_path, $cookie_domain;
		
		$cookie_val = 'l='.$login['email'].'&h='.$login['hash'].'&t='.$login['token'];
		//$life_time = time() + 3600;
		$life_time = 0;
		//var_dump_pre($cookie_val,'cookie val from string['.__LINE__.']');
		//var_dump($cookie_path, 'cookie path');
		//var_dump($cookie_domain, 'cookie dom');
		
		if( !setcookie( 'EvoSSO',  $cookie_val, $life_time, $cookie_path, $cookie_domain)) 
			wp_die('cannot set cookie. you need cookies to loggin to this site.');
		else
			return $cookie_val;
	}
	
	/*
	* name:sso_check_cookie
	* description: check if cookie if set and ok
	* */
	function sso_check_cookie(){
	
		if( isset( $_COOKIE['EvoSSO'] )){
			return true; //cookie, good
		}
		else{
			return false;
		}
	}
	
	/*
	* name:sso_del_cookie
	* description: delete the damn cookie!
	* */
	function sso_del_cookie(){
		

		$cookie_val = '';
		$life_time = time() - 3600;
		setcookie( 'EvoSSO',  $cookie_val, $life_time);
		return true;
	}
	
	/*
	* name:sso_cookie_get_values
	* description: explode and return the cookie
	* */
	function sso_cookie_get_values(){
		
		global $sso, $sso_client_title, $sso_client;
		
		/*if( ! sso_check_cookie()){
			return FALSE;
		}*/
		
		$cookiez = explode( "&", $_COOKIE['EvoSSO'] );
//		$cookiez = array( 't'=>'t=token-89hldashdhjja', 'h'=>'h=hash-daoisidasfges', 'l'=>'l=login-dfasdadda' );
		
		foreach( $cookiez as $key => $val ){
			
			$temp_p = explode( "=",$val );
			
			switch ( $temp_p['0'] ){
				case 't': 
					$param['token'] = $temp_p['1'];
				break;
				case 'h': 
					$param['hash'] = $temp_p['1'];
				break;
				case 'l': 
					$param['login'] = $temp_p['1'];
				break;
			}
		}
		//$param['ipuser'] = $_SERVER['REMOTE_ADDR'];
		//var_dump_pre($param);
		return $param;
	}
/*
	* name:sso_cookie_get_values
	* description: explode and return the cookie
	* */
	function sso_make_cookie( $vals ){
		
			
		$cookie 	 = 't='.$vals['t'];
		$cookie 	.= '&h='.$vals['h'];
		$cookie 	.= '&l='.$vals['l'];
		
		return $cookie;
	}

/**
 * @param string $tag The hook name
 */
function debug_filters( $tag = false ) {
	global $wp_filter;

	if ( $tag ) {
		$hook[ $tag ] = $wp_filter[ $tag ];

		if ( !is_array( $hook[ $tag ] ) ) {
			trigger_error("Nothing found for '$tag' hook", E_USER_NOTICE);
			return;
		}
	}
	else {
		$hook = $wp_filter;
		ksort( $hook );
	}

	echo '<pre>';
	foreach ( $hook as $tag => $priority ) {
		echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
		ksort( $priority );
		foreach ( $priority as $priority => $function ) {
			echo $priority;
			foreach( $function as $name => $properties )
				echo "\t$name<br>\n";
		}
	}
	echo '</pre>';
}

/*function get_currentuserinfo(){
	global $current_user;
	
	var_dump_pre( $current_user , 'get_currentuserinfo');
	var_dump_pre( wp_validate_auth_cookie() , 'wp_validate_auth_cookie');
	
	
	
}*/

function do_http_post_request_for_newsletter( $email ){

	$portal_url = get_option( 'nnp_public_url' );
	$portal_domain = get_domain( $portal_url );

	$url = 'http://mailing.tele.net/inxmail1/subscription/servlet';

	list( $portal, $toplevel_domain ) = explode( ".", $portal_domain ); 
	
	$data = array('INXMAIL_SUBSCRIPTION'	=>"{$toplevel_domain}.{$portal}",
              'INXMAIL_HTTP_REDIRECT'		=>$portal_url."/features/newsletter-ok",
              'INXMAIL_HTTP_REDIRECT_ERROR'	=>$portal_url."/features/newsletter-error",
              'INXMAIL_CHARSET'				=>"UTF-8",
              'email'						=>$email
              
             );

	
	$data =  http_build_query($data);
	//var_dump_pre($data);
	//die;
		
	$params = array('http' => array(
			  'method' => 'POST',
			  'content' => $data
			));
	if ( $optional_headers !== null ) {
		$params['http']['header'] = $optional_headers;
	}
	
	$ctx = stream_context_create( $params );
	$fp = @fopen( $url, 'rb', false, $ctx );

	$response = @stream_get_contents($fp);
	
	/*if (!$fp) {
	throw new Exception("Problem with $url, $php_errormsg");
	}
	$response = @stream_get_contents($fp);
	if ($response === false) {
	throw new Exception("Problem reading data from $url, $php_errormsg");
	}
	return $response;*/
	return true;
}

function wp_clear_auth_cookie_mayra(){
	setcookie(AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);
	setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);
	setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);
	setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);

}

function wp_get_associated_object_to_nav_menu_item( $menu_id = 0 ) {
	global $wpdb;
	
	
	$arr = array();

	$query = new WP_Query;
	
	//the relation between a nav_item and a custom post type
	//$sql = $wpdb->prepare("SELECT wp_6_postmeta.meta_value FROM wp_6_postmeta WHERE wp_6_postmeta.post_id = 2442 AND wp_6_postmeta.meta_key = '_menu_item_object_id'");
	$sql = $wpdb->prepare("SELECT $wpdb->postmeta.meta_value FROM $wpdb->postmeta WHERE $wpdb->postmeta.post_id = %d AND $wpdb->postmeta.meta_key='_menu_item_object_id'", $menu_id);
	$res = $wpdb->get_var($sql); //the custom post id
	
	//get image 
	/*img_arr = nnp_get_best_fit_picture( $res, "full" );
	
	$link = get_post_meta( $res, 'titlelink' );
	
	array_push($arr, $img_arr['url']);
	array_push($arr, $link[0]);
	
	return $arr;*/
	wp_reset_query();
	return $res;
}

/**********************************************************************
 *
 * array hepler functions
 * 
 *********************************************************************/
  
/*
 * transform ajax serialized form data into array ( $key => $value )
 */
function jquery_serialized2array( $str, $exp='&'){
	
	$arr = explode( $exp, $str );
	
	$ret_arr = array();
	foreach( $arr as $t ){
		$tt = explode('=', $t );
		$key = $tt[0];
		$val = $tt[1];
		$ret_arr[$key] = $val;
		
	}
	
	return $ret_arr;
}

/*
 * return value of first key 
 */
function array_key_is( $arr, $is ){
	 
	$i = new ArrayIterator( $arr );
	
	$ret_arr = '';
	while ($i->valid()) {
		
		if ( strcmp( $i->key(), $is ) === 0 ) {
			return $ret_arr = $i->current();
		}
		$i->next();
	}
	return FALSE;
 }
 
/**
 * name: array_ikey_exists( $key, $array ) {
 * description: case insensitive array_key_exists
 *
 * @param string $string 
 *
 * @return string
 */
function array_ikey_exists( $key, $arr ){
	if( preg_match( "/".$key."/i", join( ",", array_keys( $arr )))){               
		return true;
	}
	else{
		return false;
	}
} 

/*
 * name: array_keys_exists
 * description: checks if all (array) $keys are present in $array
 * use $perfect_match to check if and only if those (array) keys exists in $array
 * 
 */ 
function array_keys_exists( $array, $keys, $perfect_match = FALSE ) {
//	var_dump_pre($array);
//	var_dump_pre($keys);
	
	if( !is_array( $array ) || !is_array( $keys )){
		return false;
	}
	
	if( TRUE == $perfect_match ){//the size of arrays do not match
		if( sizeof( $array ) != sizeof( $keys )){
			return false;
		}
	}
	    
    foreach( $keys as $k ) {
        if( !array_key_exists( $k, $array )) {
			return false;
        }
    }

    return true;
}


/**
 * Get all values from specific key in a array of obj's
 *
 * @param $key string
 * @param $arr array
 * @return null|string|array
 */
function array_object_value( $key, array $arr ){
    
    $val = array();
    foreach( $arr as $obj ){
		array_push( $val, $obj -> $key);
		
	}
    
    //return count($val) > 1 ? $val : array_pop($val);
    return $val;
}

/*********************************************************************/

/*
 * name: get_users_by_role
 * description: get user by role
 * param: (string) user role
 * return: (array) users with that role
 */
function get_users_by_role( $role ) {
	
	if ( class_exists( 'WP_User_Search' ) ) {
		$wp_user_search = new WP_User_Search( '', '', $role );
		$userIDs = $wp_user_search->get_results();
	
	} else {
	
		global $wpdb, $site_id;
		
		//$blog_capability = 'wp_6_capabilities';
		switch( $site_id ){
			case 1:
				$blog_capability = 'wp_6_capabilities';
			break;
			
			case 2://ro
				$blog_capability = 'wp_6_capabilities';
			break;
			
			case 3://hu
				$blog_capability = 'wp_14_capabilities';
			break;
		}
		
		
		/*SELECT ID, user_login
			FROM wp_users
			INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id
			WHERE wp_usermeta.meta_key = 'wp_6_capabilities'
			AND wp_usermeta.meta_value LIKE '%administrator%'*/
		$query_str = "SELECT ID, user_login, user_email
						FROM wp_users 
						INNER JOIN wp_usermeta ON wp_users.ID = wp_usermeta.user_id
						WHERE wp_usermeta.meta_key = '$blog_capability'
							AND wp_usermeta.meta_value LIKE '%$role%'";
		
		$user_ids = $wpdb->get_results( $query_str , ARRAY_A );

		/*if( DEBUGEMAIL ){
			var_dump_pre( $wpdb->last_query);
			var_dump_pre($user_ids);
		}*/

		
		
	}
	return $user_ids;
}

//get user email 
function get_nth_array_value( $arr , $lvl=0, $key=0 ){
	
	$email = array();
	foreach( $arr as $t ){
		
		array_push( $email, $t['user_email']);
		
	}
	
	return $email;
}


function is_adpage($page) {
        global $wp_query;
	$page_type = $wp_query->query_vars["$page"];
	return ( isset( $page_type ) && !empty ( $page_type ) ) ? true : false;
    }
	
	
/* hotfix section */
global $wp_version;
if ( $wp_version == "3.1.3" )
	add_filter( 'request', 'wp_hotfix_313_post_status_query_string_request' );

function wp_hotfix_313_post_status_query_string_request( $qvs ) {
	if ( isset( $qvs['post_status'] ) && is_array( $qvs['post_status'] ) )
		$qvs['post_status'] = implode( ',', $qvs['post_status'] );
	
	return $qvs;
}
/* /hotfix section */

/*
 * name: get_categories_for_site
 * description: returns the categories assigned to a nnp site ( the categories set in wp-admin site options under 'sitemap settings') 
 * 
 */
function nnp_get_sitemap_cats(){
	global $nnpmcs_blog_id;
	
	$categories = get_blog_option( $nnpmcs_blog_id, 'nnpmcs_sitemap_cats' );
	if( isset( $categories ) && !empty( $categories )){
		return $categories;
	}
	return FALSE;
}


/*
 * name: get_category_portal_index
 * decription: 	returns the portal on which the category is indexed
 * 				FALSE if the category is not index on any portal
 */ 
function get_portal_index_category( $cat_id ){
	
	$portal = get_term_meta( $cat_id, 'index_on_portal', true );
	if( isset( $portal ) && !empty( $portal )){
		return $portal;
	}
	
	return FALSE;
}

function nnp_is_post_index_on_portal( $post_id ){
	
	return false;
		
}

function nnp_is_category_index_on_portal( $cat_id ){
	
	$site_cats = nnp_get_categories_for_portal();
	
	if( is_array( $site_cats ) && in_array( $cat_id, $site_cats )){
		return true;
	}
	return false;
	
}

function nnp_get_categories_for_portal(){
	
	global $nnpmcs_content_site, $nnpmcs_blog_id, $wpdb;
	
	if($nnpmcs_content_site == 1) {
		$site_cats = $wpdb->get_col("SELECT `tbl1`.`term_id` FROM `wp_termmeta` AS `tbl1`
									JOIN `wp_term_taxonomy` AS `tbl2`
									ON `tbl1`.`term_id` = `tbl2`.`term_id`
									WHERE `meta_key` LIKE 'index_on_portal'
									AND `meta_value` LIKE '{$nnpmcs_blog_id}'
									AND `tbl2`.`taxonomy` LIKE 'category'");
	} else {
		$site_cats = $wpdb->get_col("SELECT `tbl1`.`term_id` FROM `wp_{$nnpmcs_content_site}_termmeta` AS `tbl1`
									JOIN `wp_{$nnpmcs_content_site}_term_taxonomy` AS `tbl2`
									ON `tbl1`.`term_id` = `tbl2`.`term_id`
									WHERE `meta_key` LIKE 'index_on_portal'
									AND `meta_value` LIKE '{$nnpmcs_blog_id}'
									AND `tbl2`.`taxonomy` LIKE 'category'");
	}
	
	return $site_cats;
	
}

/*
 * name: get_site_public_url
 * description: return the public url of a site as defined in wp-admin on settings page under 
 * 				'Rewriting and SEO Settings' , 'Public URL for the site'
 * 
 */
function get_site_public_url( $blog_id = FALSE ){

	if( FALSE !== $blog_id ){
		$site_url = get_blog_option( $blog_id,  'nnp_public_url' );
	}
	else{
	
		global $blog_id;
	
		$site_url = get_blog_option( $blog_id,  'nnp_public_url' );
		if( !isset( $site_url ) || empty( $site_url )){
			$site_url = FALSE;
		}
	}

	return $site_url;
}



/**
 * Insert an array into another array before/after a certain key
 *
 * @param array $array The initial array
 * @param array $pairs The array to insert
 * @param string $key The certain key
 * @param string $position Wether to insert the array before or after the key
 * @return array
 */
function array_insert( $array, $pairs, $key, $position = 'after' ) {
	$key_pos = array_search( $key, array_keys( $array ) );

	if ( 'after' == $position )
		$key_pos++;

	if ( false !== $key_pos ) {
		$result = array_slice( $array, 0, $key_pos );
		$result = array_merge( $result, $pairs );
		$result = array_merge( $result, array_slice( $array, $key_pos ) );
	}
	else {
		$result = array_merge( $array, $pairs );
	}

	return $result;
}

	//check if table exists in specified database
	function table_exists ($table, $db) { 
		$tables = mysql_list_tables ($db); 
		while (list ($temp) = mysql_fetch_array ($tables)) {
			if ($temp == $table) {
				return TRUE;
			}
		}
		return FALSE;
	}

function is_mytown() {
    global $wp_query;
	if(isset($wp_query->query_vars["town"])) 
		$town = $wp_query->query_vars["town"];
	return ( isset( $town ) && !empty ( $town ) ) ? true : false;
}


/*
 * sort an array by the key of his sub-array.
 * */
/*
 * 
 * name: sksort
 * @param
 * @return
 * 
 */
function sksort( &$array, $subkey="id", $sort_ascending=false ) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
    
    return true;
}

/*
 * 
 * name: is_ajax
 * 
 * description: true if an ajax call is made
 * 
 * @param
 * @return
 * 
 */
function is_ajax() {
	if ( defined( 'DOING_AJAX' )){
		return DOING_AJAX;
	}
	return false;
}

/*
 * 
 * name: is_backend
 * 
 * description: true if the context is wp-admin, the backend
 * 
 * @param
 * @return
 * 
 */
function is_backend(){
	
	//if( is_admin() && ( is_blog_admin() || is_network_admin( ))){
	if( is_blog_admin() || is_network_admin( )){
		return TRUE;
	}
	
	return FALSE;
}
/*
 * 
 * name: is_user_logged_in
 * 
 * description: check if the user is logged in
 * 
 * @param
 * @return
 * 
 */
function is_user_logged_in() {
	global $current_user;
	//$user = wp_get_current_user();
	//var_dump( $user );
	//var_dump( $current_user );
	//var_dump( empty( $current_user ));
	
	/*if(!is_ajax() ){
		var_dump( current_filter());
		var_dump( 'is_backend: '.is_backend( ));
		var_dump( 'is_admin: '.is_admin( ));
		var_dump( 'is_ajax: '.is_ajax( ));
		var_dump( 'is_blog_admin: '.is_blog_admin());
		var_dump( 'is_network_admin: '.is_network_admin( ));
	}
	*/
	/*if( isset( $_COOKIE['EvoSSO'] )){
		var_dump( 'EvoSSOcookie: '.$_COOKIE['EvoSSO'] );
	}
	else{
		var_dump( 'no EvoSSO cookie' );
	}
	
	
	if( isset( $_COOKIE['wordpress_logged_in_'] )){
		var_dump( 'wordpress_logged_in_: '.$_COOKIE['wordpress_logged_in_'] );
	}
	else{
		var_dump('no wordpress_logged_in_ cookie' );
	}
	
	//var_dump( 'is_user_logged_in( ): '.is_user_logged_in( ) );
	var_dump( '************************' );
	*/
	//echo '-*-';
	//return false;	
	if( is_backend() || is_ajax()){//for editor login
		$user = wp_validate_auth_cookie();
		//var_dump_pre( $user, 'wp_validate_auth_cookie');
		//var_dump_pre('is admin');
		//$user = wp_get_current_user();
		//var_dump($user);
		if ( !$user ){
			wp_set_current_user(0);
		 	return false;
		}
		//return false;	
		return true;
	}

	//for user login
	if( !is_ajax()){
		if( !isset( $_COOKIE['EvoSSO'] ) || $_COOKIE['EvoSSO'] == '' ){
			return false;
		}
	}
		
	if( !isset( $_COOKIE['wordpress_logged_in_'] ) || $_COOKIE['wordpress_logged_in_'] == '' ){
		return false;
	}
	
	$user_arr =  explode( '|', $_COOKIE['wordpress_logged_in_']);
	$user_m =  $user_arr[0] ;
	$user_obj = get_user_by( 'login', $user_m );
	//var_dump_pre( $user_m, 'user' );
	//var_dump_pre( $user_obj->ID, 'user id' );
	
	wp_set_current_user( $user_obj->ID );
	
	$c_user = wp_get_current_user();
	
	if ( $c_user->id == 0 ){
		return false;
	}

	//var_dump_pre( $c_user,  'wp_get_current_user');
	return true;
}

/*
 * 
 * name: is_user_logged_in_sso
 * 
 * description: check if a user is logged in via sso
 * 
 * @param
 * @return
 * 
 */
function is_user_logged_in_sso(){
	
	global $current_user;
		
	if( !isset( $_COOKIE['EvoSSO'] ) || $_COOKIE['EvoSSO'] == '' ){
		return false;
	}
	
	if( !isset( $_COOKIE['wordpress_logged_in_'] ) || $_COOKIE['wordpress_logged_in_'] == '' ){
		return false;
	}
	
	$user_arr =  explode( '|', $_COOKIE['wordpress_logged_in_']);
	$user_m =  $user_arr[0] ;
	$user_obj = get_user_by( 'login', $user_m );
	//var_dump_pre( $user_m, 'user' );
	//var_dump_pre( $user_obj->ID, 'user id' );
	
	wp_set_current_user( $user_obj->ID );
	
	$c_user = wp_get_current_user();
	
	if ( $c_user->id == 0 ){
		return false;
	}

	//var_dump_pre( $c_user,  'wp_get_current_user');
	return true;
}
function nnp_special_chars_replacement( $content ) {
    //$content = htmlspecialchars($content);
    //$content = str_replace(chr(128), htmlspecialchars(chr(128)), $content);
//    $content = str_replace(chr(129), "&#8364;", $content);
//    $content = str_replace(chr(130), "&#8218;", $content);
//    $content = str_replace(chr(131), "&#402;", $content);
//    $content = str_replace(chr(132), "&#8222;", $content);
//    $content = str_replace(chr(133), "&#8230;", $content);
//    $content = str_replace(chr(134), "&#8224;", $content);
//    $content = str_replace(chr(135), "&#8225;", $content);
//    $content = str_replace(chr(136), "&#710;", $content);
//    $content = str_replace(chr(137), "&#8240;", $content);
//    $content = str_replace(chr(138), "&#352;", $content);
//    $content = str_replace(chr(139), "&#8249;", $content);
//    $content = str_replace(chr(140), "&#338;", $content);
//    $content = str_replace(chr(142), "&#381;", $content);
//    $content = str_replace(chr(145), "&#8216;", $content);
//    $content = str_replace(chr(146), "&#8217;", $content);
//    $content = str_replace(chr(147), "&#8220;", $content);
//    $content = str_replace(chr(148), "&#8221;", $content);
//    $content = str_replace(chr(149), "&#8226;", $content);
//    $content = str_replace(chr(152), "&#732;", $content);
//    $content = str_replace(chr(153), "&#8482;", $content);
//    $content = str_replace(chr(154), "&#353;", $content);
//    $content = str_replace(chr(155), "&#8250;", $content);
//    $content = str_replace(chr(156), "&#339;", $content);
//    $content = str_replace(chr(158), "&#382;", $content);
//    $content = str_replace(chr(159), "&#376;", $content);

    //$content = str_replace(chr(150), "&#8211;", $content);
    
    $content = str_replace(chr(194).chr(150), "-", $content);
    $content = str_replace(chr(194).chr(132), '„', $content);
    $content = str_replace(chr(194).chr(147), '“', $content);
    $content = str_replace( "\xC2\x86", "&#134;", $content ); //cross sign for mytown obituarys
    $content = str_replace( "\xC2\x80", "&#128;", $content ); //euro sign
    $content = str_replace( "\xC2\x92", "&#146;", $content ); //apostroph
    $content = str_replace( "\xC2\x96", "-", $content );
    if(!is_admin())
		$content = str_replace( '(shy)', "&shy;", $content );
    
    //$content = str_replace(chr(195), htmlspecialchars(chr(195)), $content);
    //$content = str_replace(chr(150), htmlspecialchars(chr(150)), $content);
    
    
    return $content;
}

function decrypt_mail_address( $mail_address ) {
	$n = 0;
	$r = "";
	
	for( $i = 0; $i < strlen( $mail_address ); $i++ ) {
		$n = ord( substr( $mail_address, $i ) );
		if( $n >= 8364 ) {
			$n = 128;
		}
		
		$r .= chr( $n - 1 );
	}
	return $r;
}

/**
 * Remove a given term from the specified post
 *
 * Helper function since this functionality doesn't exist in core
 */
function vmh_remove_post_term( $post_id, $term, $taxonomy ) {

	if ( ! is_numeric( $term ) ) {
		$term = get_term( $term, $taxonomy );
		if ( ! $term || is_wp_error( $term ) )
			return false;
		$term_id = $term->term_id;
	} else {
		$term_id = $term;
	}

	// Get the existing terms and only keep the ones we don't want removed
	$new_terms = array();
	$current_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );

	foreach ( $current_terms as $current_term ) {
		if ( $current_term != $term_id )
			$new_terms[] = intval( $current_term );
	}

	return wp_set_object_terms( $post_id, $new_terms, $taxonomy );
}


function nnp_is_vmh_video( $url ) {
	$videoportals = array(
		'http://video.vol.at', 'http://video.vienna.at', 'http://video.salzburg24.at', 'http://video.austria.com',
		'http://video.tion.ro', 'http://video.aradon.ro', 'http://video.bihon.ro', 'http://video.caon.ro', 'http://video.clon.ro', 'http://video.huon.ro', 'http://video.roon.ro',
		'http://video.mon.hu', 'http://video.boon.hu', 'http://video.szon.hu', 'http://video.haon.hu', 'http://video.erdon.ro',
	);

	foreach ( $videoportals as $vp ) {
		if ( strpos( $url, $vp ) !== FALSE )
			return true;
	}
	return false;

}



/*return an attribute of user comment object */
function array_map_comment( $attr, $arr ){
	$res = array();
	foreach( $arr as $item){
		$res[] = $item->$attr;
	}
	return $res;
}
?>
