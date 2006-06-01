<?php
/*
Plugin Name: UF Plugin Framework
Version: 1.0
Plugin URI: http://www.webadmin.ufl.edu/
Description: Generic plugin framework for WordPress sites at the University of Florida.
Author: Daniel Westermann-Clark
Author URI: http://dev.webadmin.ufl.edu/~dwc/
*/

define('UF_PLUGIN_FRAMEWORK_BASE', dirname(__FILE__) . '/');
define('UF_PLUGIN_FRAMEWORK_LIBRARY', UF_PLUGIN_FRAMEWORK_BASE . '/lib/');

/*
 * Required files for the framework; other plugins can require stuff
 * as appropriate.
 */
require_once(UF_PLUGIN_FRAMEWORK_LIBRARY . '/class.UfUtilities.php');

/*
 * Bootstrap the framework.
 */
add_action('init', 'uf_plugin_framework_init');


function uf_plugin_framework_init() {
	$uf_plugin_framework_plugin = $_REQUEST['uf_plugin_framework_plugin'];
	$uf_plugin_framework_action = $_REQUEST['uf_plugin_framework_action'];

	if ($uf_plugin_framework_plugin and $uf_plugin_framework_action) {
		if (uf_plugin_framework_is_admin_request()) {
			if (function_exists('auth_redirect')) {
				auth_redirect();
			}
			else {
				die('UF Plugin Framework: Unable to redirect for authentication');
			}
		}

		$action_name = UfUtilities::get_action_name($uf_plugin_framework_plugin, $uf_plugin_framework_action);

		if ($_REQUEST['uf_plugin_framework_debug']) {
			global $wp_filter;

			print_r($wp_filter);
			print "action_name = [$action_name]";
		}

		do_action($action_name);
		die('UF Plugin Framework: Finished');
	}
}

function uf_plugin_framework_is_admin_request() {
	return (strstr($_SERVER['PHP_SELF'], 'wp-admin'));
}

function uf_plugin_framework_uri() {
	bloginfo('url');
}
?>
