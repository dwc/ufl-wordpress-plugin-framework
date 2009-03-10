<?php
/*
 * An admin page for a UF WordPress plugin.
 */
if (! class_exists('UfAdminPage')) {
	class UfAdminPage {
		var $title;
		var $description;
		var $capability;
		var $type;
		var $types = array('management', 'options', 'theme', 'users', 'dashboard', 'posts', 'media', 'links', 'pages', 'comments');

		function UfAdminPage($title, $description = '', $capability = 'activate_plugins', $type) {
			$this->title = $title;
			$this->description = $description;
			$this->capability = $capability;

			// XXX: Add validation?
			$this->type = $type;
		}

		function display() {
		}
	}
}
?>
