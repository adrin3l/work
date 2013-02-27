<?php
if ( !is_singular() ):
	pyramid_loop_nav();	
elseif ( is_singular( 'post' ) ) :
	pyramid_loop_nav_singular_post();
endif;
?>