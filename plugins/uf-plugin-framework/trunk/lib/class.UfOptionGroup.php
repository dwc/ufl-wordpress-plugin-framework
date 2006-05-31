<?php
/*
 * An option group for a UF WordPress plugin.
 */
if (! class_exists('UfOptionGroup')) {
	class UfOptionGroup {
		var $name;
		var $options;

		function UfOptionGroup($name = '', $options = array()) {
			$this->name = $name;
			$this->options = $options;
		}
	}
}
?>
