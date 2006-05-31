<?php
/*
 * A management page for UF WordPress plugins.
 */
if (! class_exists('UfManagementPage')) {
	class UfManagementPage {
		var $title;
		var $description;
		var $level;

		function UfManagementPage($title, $description = '', $level = 3) {
			$this->title = $title;
			$this->description = $description;
			$this->level = $level;
		}

		function display() {
		}
	}
}
?>
