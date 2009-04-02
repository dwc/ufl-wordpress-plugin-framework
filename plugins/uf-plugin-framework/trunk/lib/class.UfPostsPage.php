<?php
require_once('class.UfAdminPage.php');


/*
 * A media page for UF WordPress plugins.
 */
if (! class_exists('UfPostsPage')) {
	class UfPostsPage extends UfAdminPage {
		function UfPostsPage($title, $description = '', $capability = 'edit_posts') {
			$this->{get_parent_class(__CLASS__)}($title, $description, $capability, 'posts');
		}
	}
}
?>
