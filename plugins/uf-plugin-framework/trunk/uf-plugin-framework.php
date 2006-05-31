<?php
/*
Plugin Name: UF Plugin Framework
Version: 1.0
Plugin URI: http://www.webadmin.ufl.edu/
Description: Generic plugin framework for WordPress sites at the University of Florida.
Author: Daniel Westermann-Clark
Author URI: http://www.webadmin.ufl.edu/
*/

define('UF_PLUGIN_FRAMEWORK_PLUGIN_BASE', dirname(__FILE__) . '/');

/*
 * Required files for the framework; other plugins can include stuff
 * from lib as appropriate.
 */
require_once('lib/class.UfUtilities.php');

/*
 * Bootstrap the framework.
 */
add_action('init', 'uf_plugin_framework_init');

function uf_plugin_framework_init() {
	$uf_plugin_framework_plugin = get_query_var('uf_plugin_framework_plugin');
	$uf_plugin_framework_action = get_query_var('uf_plugin_framework_action');

	if ($uf_plugin_framework_plugin and $uf_plugin_framework_action) {
		$the_action = UfUtilities::get_action_name($uf_plugin_framework_plugin, $uf_plugin_framework_action);
		do_action($the_action);
	}
}

function uf_plugin_framework_uri($plugin, $action, $is_admin = false) {
}

function uf_admin_plugin_framework_uri($plugin, $action) {
	return uf_plugin_framework_uri($plugin, $action, true);
}
?>
