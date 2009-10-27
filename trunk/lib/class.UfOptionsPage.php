<?php
require_once('class.UfAdminPage.php');


/*
 * An options page for a UF WordPress plugin.
 */
if (! class_exists('UfOptionsPage')) {
	class UfOptionsPage extends UfAdminPage {
		var $option_groups;

		function UfOptionsPage($title, $description = '', $option_groups = array()) {
			$this->option_groups = $option_groups;

			$this->{get_parent_class(__CLASS__)}($title, $description, 'manage_options', 'options');
		}

		function display_body() {
			$page_options = array();
?>
	<form method="post" action="options.php">
<?php foreach ($this->option_groups as $option_group): ?>
		<h3><?php echo htmlspecialchars($option_group->name); ?></h3>
		<table class="form-table">
<?php     foreach ($option_group->options as $option): ?>
<?php         $page_options[] = $option->name; ?>
<?php         $option->display(); ?>
<?php     endforeach; ?>
		</table><!-- .form-table -->
<?php endforeach; ?>

		<?php if (function_exists('wp_nonce_field')): wp_nonce_field('update-options'); endif; ?>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo implode(",", $page_options); ?>" />

<?php $this->submit_button('Update Options'); ?>
	</form>
<?php
		}
	}
}
?>
