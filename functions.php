<?php

if (!defined('ABSPATH')) {
	exit;
}
if (!function_exists('neve_child_load_css')) :
	/**
	 * Load CSS file.
	 */
	function neve_child_load_css()
	{
		wp_enqueue_style('neve-child-style', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('neve-style'), NEVE_VERSION);
	}
endif;
add_action('wp_enqueue_scripts', 'neve_child_load_css', 20);

// function that runs when shortcode is called
function private_dashboard()
{
	$message = 'Hello world!';
	echo get_edit_profile_url();
	//echo get_currentuserinfo();

	return $message;
}
// register shortcode
add_shortcode('private_dashboard', 'private_dashboard');

function menu_by_login_status($args = '')
{
	if (is_user_logged_in()) {
		$args['menu'] = 'principale-logged';
	} else {
		$args['menu'] = 'principale';
	}
	return $args;
}
add_filter('wp_nav_menu_args', 'menu_by_login_status');

function hide_private_posts($query)
{
	if ($query->is_home) {
		$query->set('cat', '-15');
	}
	return $query;
}
add_filter('pre_get_posts', 'hide_private_posts');
