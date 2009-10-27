<?php
require_once('class.UfAdminPage.php');


/*
 * A media page for UF WordPress plugins.
 */
if (! class_exists('UfMediaPage')) {
	class UfMediaPage extends UfAdminPage {
		function UfMediaPage($title, $description = '', $capability = 'edit_posts') {
			$this->{get_parent_class(__CLASS__)}($title, $description, $capability, 'media');
		}
	}
}
?>
