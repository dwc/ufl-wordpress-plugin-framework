<?php
require_once('class.UfNewsController.php');

/*
 * Controller for the UF News administration section.
 */
if (! class_exists('UfNewsAdminController')) {
	class UfNewsAdminController extends UfNewsController {
		function UfNewsAdminController() {
			$args = func_get_args();
			parent::_init($args);
		}

		function handle_request() {
			if (function_exists('auth_redirect')) {
				auth_redirect();
				parent::handle_request();

				$return_to = $_REQUEST['return_to'];

				// The plugins are done, redirect
				if ($return_to) {
					header('Location: ' . get_settings('siteurl') . $return_to);
				}
				else {
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
			}
			else {
				die('Could not call function auth_redirect');
			}
		}
	}
}
?>
