<?php
/*
 * Utility functions for UF WordPress plugin options.
 */
if (! class_exists('UfOptionUtilities')) {
	class UfOptionUtilities {
		function add_options($option_groups) {
			if (current_user_can('manage_options')) {
				foreach ($option_groups as $option_group) {
					foreach ($option_group->options as $option) {
						add_option($option->name, $option->default_value, $option->description);
					}
				}
			}
		}
	}
}
?>
