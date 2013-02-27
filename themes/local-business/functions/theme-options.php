<?php

add_action('init', 'of_options');
if (!function_exists('of_options')) {

    function of_options() {
        // VARIABLES
        $themename = wp_get_theme('style.css');
        $themename = 'Local Business';
        $shortname = "of";
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = localbusiness_get_option('of_options');
        //Front page on/off
        $file_rename = array("on" => "On", "off" => "Off");
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }

        // Populate OptionsFramework option in array for use in theme
        $contact_option = array("on" => "On", "off" => "Off");
		$captcha_option = array("on" => "On", "off" => "Off");
        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath = get_template_directory_uri() . '/images/';

        $options = array(
     array("name" => "General Settings",
            "type" => "heading"),

     array("name" => "Custom Logo",
            "desc" => "Choose your own logo. Optimal Size: 300px Wide by 90px Height.",
            "id" => "localbusiness_logo",
            "type" => "upload"),

     array("name" => "Custom Favicon",
            "desc" => "Specify a 16px x 16px image that will represent your website's favicon.",
            "id" => "localbusiness_favicon",
            "type" => "upload"),

     array("name" => "Top Right Contact Details",
            "desc" => "Enter your contact detail/number to display it at the top right corner.",
            "id" => "localbusiness_topright",
            "std" => "",
            "type" => "textarea"),
			
     array("name" => "Contact No.",
            "desc" => "Enter your contact number on which you want to receive call's 
			(Feature active only when site is viewed on moblie devices).
			example: +91-1800-548-783",
            "id" => "localbusiness_contact_number",
            "std" => "",
            "type" => "text"),

     array("name" => "Tracking Code",
            "desc" => "Paste your Google Analytics (or other) tracking code here.",
            "id" => "localbusiness_analytics",
            "std" => "",
            "type" => "textarea"),

      array("name" => "Front Page On/Off",
            "desc" => "Check on for enabling front page or check off for enabling blog page in front page",
            "id" => "re_nm",
            "std" => "on",
            "type" => "radio",
            "options" => $file_rename),
			
      array("name" => "Home page Top Settings",
            "type" => "heading"),
			
      array("name" => "Top Feature Image",
            "desc" => "Choose your image or video. Optimal size is 363px wide and height 285px",
            "id" => "localbusiness_slideimage1",
            "std" => "",
            "type" => "upload"),

     array("name" => "Top Feature Image Link",
            "desc" => "Enter yout link url for Top Feature Image",
            "id" => "localbusiness_slidelink1",
            "std" => "",
            "type" => "text"),

    array("name" => "Top Feature Heading",
            "desc" => "Enter your text for Top Feature.",
            "id" => "localbusiness_slider_heading",
            "std" => "",
            "type" => "textarea"),

    array("name" => "Top Feature Description",
            "desc" => "Enter your text for Top Feature Description.",
            "id" => "localbusiness_slider_description",
            "std" => "",
            "type" => "textarea"),

     array("name" => "Top Feature button text",
            "desc" => "Enter your text for Top Feature button text",
            "id" => "localbusiness_slider_read_more",
            "std" => "",
            "type" => "text"),

     array("name" => "Top Feature  Link ",
            "desc" => "Enter your text for Top Feature  Link.",
            "id" => "localbusiness_slider_link",
            "std" => "",
            "type" => "text"),

        //Homepage Feature Area
     array("name" => "Homepage Feature Area",
            "type" => "heading"),
        //Right Feature Separetor
      array("name" => "First Feature Heading",
            "desc" => "Enter your text for first col heading.",
            "id" => "localbusiness_firsthead",
            "std" => "",
            "type" => "textarea"),
       array("name" => "First Feature Description",
            "desc" => "Enter your text for first col description.",
            "id" => "localbusiness_firstdesc",
            "std" => "",
            "type" => "textarea"),
       array("name" => "First feature Link",
            "desc" => "Enter your text for First feature Link.",
            "id" => "localbusiness_feature_link1",
            "std" => "",
            "type" => "text"),

        //Second Feature Separetor
      array("name" => "Second Feature Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),
       array("name" => "Second Feature Heading",
            "desc" => "Enter your text for second col heading.",
            "id" => "localbusiness_secondhead",
            "std" => "",
            "type" => "textarea"),
       array("name" => "Second Col Description",
            "desc" => "Enter your text for second col description.",
            "id" => "localbusiness_seconddesc",
            "std" => "",
            "type" => "textarea"),
       array("name" => "Second feature Link",
            "desc" => "Enter your text for Second feature Link.",
            "id" => "localbusiness_feature_link2",
            "std" => "",
            "type" => "text"),

        //Third Feature Separetor
       array("name" => "Third Feature Starts From Here.",
            "type" => "saperate",
            "class" => "saperator"),
       array("name" => "Third Feature Heading",
            "desc" => "Enter your text for second col heading.",
            "id" => "localbusiness_thirdhead",
            "std" => "",
            "type" => "textarea"),
       array("name" => "Third Feature Description",
            "desc" => "Enter your text for Third Feature description.",
            "id" => "localbusiness_thirddesc",
            "std" => "",
            "type" => "textarea"),
       array("name" => "Third feature Link",
            "desc" => "Enter your text for Second feature Link.",
            "id" => "localbusiness_feature_link3",
            "std" => "",
            "type" => "text"),

        //Left Feature Area
        array("name" => "Left Feature",
            "type" => "saperate",
            "class" => "saperator"),
        array("name" => "Left Feature Heading",
            "desc" => "Enter your text for LeftFeature heading.",
            "id" => "localbusiness_lefthead",
            "std" => "",
            "type" => "textarea"),

         array("name" => "Left Feature Description",
            "desc" => "Enter your text for Left Feature description.",
            "id" => "localbusiness_leftdesc",
            "std" => "",
            "type" => "textarea"),

       array("name" => "Right Feature",
            "type" => "saperate",
            "class" => "saperator"),

        array("name" => "Right Feature Section.",
            "desc" => "Enter your text for Feature Section. if you are putting any type of embed content for eg: youtube/vimeo videos or facebook embed code, make sure optimal width and height is equal to 300px and 235px respectively ",
            "id" => "localbusiness_rightdesc",
            "std" => "",
            "type" => "textarea"),
//****=============================================================================****//
//****-----------This code is used for creating color styleshteet options----------****//							
//****=============================================================================****//				
        array("name" => "Styling Options",
            "type" => "heading"),
         array("name" => "Custom CSS",
            "desc" => "Quickly add some CSS to your theme by adding it to this block.",
            "id" => "localbusiness_customcss",
            "std" => "",
            "type" => "textarea"));
        localbusiness_update_option('of_template', $options);
        localbusiness_update_option('of_themename', $themename);
        localbusiness_update_option('of_shortname', $shortname);
    }

}
?>
