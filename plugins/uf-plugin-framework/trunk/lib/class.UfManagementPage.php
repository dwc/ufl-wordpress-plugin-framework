<?php
/*
 * A management page for UF WordPress plugins.
 */
if (! class_exists('UfManagementPage')) {
	class UfManagementPage {
		var $title;
		var $description;
		var $capability;

		function UfManagementPage($title, $description = '', $capability = 'edit_posts') {
			$this->title = $title;
			$this->description = $description;
			$this->capability = $capability;
		}

		function display() {
		}
	}
}
?>
