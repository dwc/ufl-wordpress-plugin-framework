<?php
/*
Plugin Name: UF Plugin Framework
Version: 2.0
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
		if (is_admin()) {
			check_admin_referer($uf_plugin_framework_plugin . '-' . $uf_plugin_framework_action);
		}

		$action_name = UfUtilities::get_action_name($uf_plugin_framework_plugin, $uf_plugin_framework_action);

		if ($_REQUEST['uf_plugin_framework_debug']) {
			global $wp_filter;

			print_r($wp_filter);
			print "action_name = [$action_name]";
		}

		do_action($action_name);
		die('');
	}
}

function uf_plugin_framework_uri() {
	return site_url('index.php');
}

function uf_plugin_framework_admin_uri() {
	return admin_url('admin.php');
}

function uf_plugin_framework_form_fields($uf_plugin_framework_plugin, $uf_plugin_framework_action, $padding = '') {
?>
<?php echo htmlspecialchars($padding); ?><input type="hidden" name="uf_plugin_framework_plugin" value="<?php echo htmlspecialchars($uf_plugin_framework_plugin); ?>" />
<?php echo htmlspecialchars($padding); ?><input type="hidden" name="uf_plugin_framework_action" value="<?php echo htmlspecialchars($uf_plugin_framework_action); ?>" />
<?php
}

function uf_plugin_framework_admin_form_fields($uf_plugin_framework_plugin, $uf_plugin_framework_action, $padding = '') {
	echo htmlspecialchars($padding);
	wp_nonce_field($uf_plugin_framework_plugin . '-' . $uf_plugin_framework_action);
	echo "\n";
	uf_plugin_framework_form_fields($uf_plugin_framework_plugin, $uf_plugin_framework_action, $padding);
}
?>
