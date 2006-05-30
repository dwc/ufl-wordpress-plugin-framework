<?php
/*
 * An option for a UF WordPress plugin.
 */
if (! class_exists('UfOption')) {
	class UfOption {
		var $name;
		var $default_value;
		var $description;
		var $units;

		function UfOption($name, $default_value = '', $description = '', $units = '') {
			$this->name = $name;
			$this->default_value = $default_value;
			$this->description = $description;
			$this->units = $units;
		}
	}
}
?>
