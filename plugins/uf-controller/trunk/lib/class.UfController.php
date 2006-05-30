<?php
require_once(PLUGINS_LIBRARY . 'class.UfNewsUtilities.php');

/*
 * Controller for UF News.  Plugins can register functions using
 * add_action(UfNewsUtilities::get_action_name(...), ...), and the
 * controller will dispatch requests to the plugin by calling the
 * action.
 */
if (! class_exists('UfNewsController')) {
	class UfNewsController {
		function UfNewsController() {
			$args = func_get_args();
			call_user_func_array(array(&$this, '_init'), $args);
		}

		function _init() {
		}

		function handle_request() {
			$uf_news_controller_plugin = $_REQUEST['uf_news_controller_plugin'];
			$uf_news_controller_action = $_REQUEST['uf_news_controller_action'];

			if ($uf_news_controller_plugin and $uf_news_controller_action) {
				$the_action = UfNewsUtilities::get_action_name($uf_news_controller_plugin, $uf_news_controller_action);
				do_action($the_action);
			}
			else {
				die("Both plugin and action must be specified! (uf_news_controller_plugin = [$uf_news_controller_plugin], uf_news_controller_action = [$uf_news_controller_action])");
			}
		}
	}
}
?>
