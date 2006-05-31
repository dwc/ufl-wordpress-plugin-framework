<?php
require_once('class.UfController.php');

/*
 * Controller for the administration section.
 */
if (! class_exists('UfAdminController')) {
	class UfAdminController extends UfController {
		function UfAdminController() {
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
