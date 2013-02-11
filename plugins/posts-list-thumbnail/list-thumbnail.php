<?php
/*
  Plugin Name: Posts List Thumbnails
  Description: Adds post thumbnail in posts list
  Author: Daniel Andrei-Adrian
  Version: 1.0
  */

class list_thumbnail{

    function init(){

        add_theme_support('post-thumbnails', array( 'post', 'page' ) );  

        // for posts  
        add_filter( 'manage_posts_columns',array(__CLASS__, 'addcolumn' ));  
        add_action( 'manage_posts_custom_column', array(__CLASS__,'addthumb'), 10, 2 );  
          
        // for pages  
        add_filter( 'manage_pages_columns', array(__CLASS__, 'addcolumn' ) );  
        add_action( 'manage_pages_custom_column', array(__CLASS__,'addthumb'), 10, 2 ); 
    }
    function addcolumn($cols) {  
        $cols['thumbnail'] = __('Thumbnail');  
        return $cols;  
    }  
      
    function addthumb($column_name, $post_id) {  
        $width = (int) 40;  
        $height = (int) 40;  
        if ( 'thumbnail' == $column_name ) {  

            $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );  
            $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );  
              
            if ($thumbnail_id)  
                $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );  
            elseif ($attachments) {  
                foreach ( $attachments as $attachment_id => $attachment ) {  
                $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );  
            }  
        }  
            if ( isset($thumb) && $thumb ) {
                echo $thumb; 
            }  
            else {
            echo __('None'); 
            }  
        }  
    }  
}
list_thumbnail::init();