<?php
require_once('class.UfAdminPage.php');


/*
 * A management page for UF WordPress plugins.
 */
if (! class_exists('UfManagementPage')) {
	class UfManagementPage extends UfAdminPage {
		function UfManagementPage($title, $description = '', $capability = 'edit_posts') {
			$this->{get_parent_class(__CLASS__)}($title, $description, $capability, 'management');
		}
	}
}
?>
