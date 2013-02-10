=== Plugin Name ===
Contributors: Daniel Andrei Adrian
Tags: posts views
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.5
License: GPLv2 or later

Plugin helps you see your posts views

== Description ==

Plugin adds a new action in single.php 'post_views' that will count post views and display it in posts backend



== Frequently Asked Questions ==

= How does it works ? =

For each post plugin will create a meta_key "post_views", and value for this will be increased on every post request

== Screenshots ==

1.In Screenshot you can see how you can content to popupbox and does it look in front-end


== Installation ==

1. Upload automatic-posting to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add following line in single.php of wordpress template.

<?php do_action('post_views');?>

== Changelog ==

= 1.0 =
* Add a functionality for post views counter


== Upgrade Notice ==

= 1.0 =
* You will see post views in post backend.

