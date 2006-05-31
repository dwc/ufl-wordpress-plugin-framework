<?php
/*
 * Utility functions for UF WordPress plugin options.
 */
if (! class_exists('UfOptionUtilities')) {
	class UfOptionUtilities {
		function add_options($option_groups) {
			global $user_level;

			if (function_exists('get_currentuserinfo')) {
				get_currentuserinfo();
				if ($user_level < 8) return;

				foreach ($option_groups as $option_group) {
					foreach ($option_group->options as $option) {
						add_option($option->name, $option->default_value, $option->description);
					}
				}
			}
			else {
				die('Could not call function get_currentuserinfo');
			}
		}
	}
}
?>
