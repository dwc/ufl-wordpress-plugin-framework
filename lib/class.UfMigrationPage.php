<?php
require_once('class.UfManagementPage.php');


/*
 * A migration page for UF WordPress plugins.
 */
if (! class_exists('UfMigrationPage')) {
	class UfMigrationPage extends UfManagementPage {
		function UfMigrationPage($title, $description = '', $capability = 'import') {
			$this->{get_parent_class(__CLASS__)}($title, $description, $capability);
		}
	}
}
?>
