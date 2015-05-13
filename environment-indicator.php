<?php

/**
 * Plugin Name: Environment Indicator
 * Plugin URI: https://github.com/betawax/environment-indicator
 * Description: Display the current environment in the admin bar.
 * Version: 1.0.0
 * Author: Holger Weis
 * Author URI: http://betawax.io
 * License: MIT
 */

/**
 * Display the current environment in the admin bar.
 *
 * @param  WP_Admin_Bar  $wp_admin_bar
 * @return void
 */
function environment_indicator($wp_admin_bar)
{
	$args = [
		'id'     => 'environment-indicator',
		'title'  => ucfirst(WP_ENV),
		'parent' => 'top-secondary',
		'href'   => '#',
		'meta'   => ['class' => 'environment-indicator'],
	];
	
	$wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'environment_indicator', 999);

/**
 * Add some CSS to style the current environment.
 *
 * @return void
 */
function environment_indicator_css()
{
	$colors = [
		'development' => '#2ecc71',
		'staging'     => '#f1c40f',
		'production'  => '#e74c3c',
		'fallback'    => '#3498db',
	];
	
	$color = array_key_exists(WP_ENV, $colors) ? $colors[WP_ENV] : $colors['fallback'];
	
	echo '<style>.environment-indicator { background-color: '.$color.' !important; } .environment-indicator a { font-weight: bold !important; }</style>';
}

add_action('admin_head', 'environment_indicator_css');
add_theme_support('admin-bar', ['callback' => 'environment_indicator_css']);
