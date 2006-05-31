<?php
require_once(PLUGINS_LIBRARY . 'class.UfUtilities.php');

/*
 * Controller for UF WordPress sites.
 */
if (! class_exists('UfController')) {
	class UfController {
		function UfController() {
			$args = func_get_args();
			call_user_func_array(array(&$this, '_init'), $args);
		}

		function _init() {
		}

		function handle_request() {
			$uf_controller_plugin = $_REQUEST['uf_controller_plugin'];
			$uf_controller_action = $_REQUEST['uf_controller_action'];

			if ($uf_controller_plugin and $uf_controller_action) {
				$the_action = UfUtilities::get_action_name($uf_controller_plugin, $uf_controller_action);
				do_action($the_action);
			}
			else {
				die("Both plugin and action must be specified! (uf_controller_plugin = [$uf_controller_plugin], uf_controller_action = [$uf_controller_action])");
			}
		}
	}
}
?>
