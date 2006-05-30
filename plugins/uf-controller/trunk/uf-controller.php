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
 * from lib as appropriate
 */
require_once('lib/class.UfAdminController.php');
require_once('lib/class.UfController.php');
?>
