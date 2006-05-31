<?php
/*
Plugin Name: UF Controller
Version: 1.0
Plugin URI: http://www.webadmin.ufl.edu/
Description: Generic controller framework for WordPress sites at the University of Florida. Plugins can load actions into the controller.
Author: Daniel Westermann-Clark
Author URI: http://www.webadmin.ufl.edu/
*/

define('UF_CONTROLLER_PLUGIN_BASE', dirname(__FILE__) . '/');

/*
 * Required files for the controller framework; other plugins can include stuff
 * from lib as appropriate.
 */
require_once('lib/class.UfAdminController.php');
require_once('lib/class.UfController.php');

/*
 * Bootstrap the controller framework.
 */
add_action('init', 'uf_controller_init');

function uf_controller_init() {
	$uf_controller_plugin = get_query_var('uf_controller_plugin');
	$uf_controller_action = get_query_var('uf_controller_action');

	if ($uf_controller_plugin and $uf_controller_action) {
		$the_action = UfUtilities::get_action_name($uf_controller_plugin, $uf_controller_action);
		do_action($the_action);
	}
}

function uf_controller_uri($plugin, $action, $is_admin = false) {
}

function uf_admin_controller_uri($plugin, $action) {
	return uf_controller_uri($plugin, $action, true);
}
?>
