<?php
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