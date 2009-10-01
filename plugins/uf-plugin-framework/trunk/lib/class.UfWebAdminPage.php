<?php
require_once('class.UfAdminPage.php');


/*
 * A Web Administration Management page for UF WordPress plugins.
 */
if (! class_exists('UfWebAdminPage')) {
	class UfWebAdminPage extends UfAdminPage {
	  function UfWebAdminPage($title, $description = '', $capability = 'edit_posts') {
		  $this->{get_parent_class(__CLASS__)}($title, $description, $capability, 'options');
		}
	}
}
?>
