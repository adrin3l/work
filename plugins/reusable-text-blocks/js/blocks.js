jQuery( document ).ready( function($) {

	jQuery('#menu-posts-text-blocks ul li.wp-first-item a').html('Admin Tools');

	var block = jQuery('#menu-posts-text-blocks ul li.wp-first-item ').html();

	jQuery('#menu-posts-text-blocks').remove();

	jQuery("#menu-settings ul li:last").after('<li>'+block+'</li>');

	//jQuery("#menu-settings ul li:last a").html('Admin Tools');


	//alert(block);
});