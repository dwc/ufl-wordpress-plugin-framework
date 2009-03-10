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

		function display() {
			$this->display_start();
			$this->display_options();
			$this->display_end();
		}

		function display_start() {
?>
<div class="wrap">
  <h2><?php echo htmlspecialchars($this->title); ?></h2>
<?php if ($this->description): ?>
  <p><?php echo $this->description; ?></p>
<?php endif; ?>
<?php
		}

		function display_end() {
?>
</div>
<?php
		}

		function display_options() {
			$page_options = array();
?>
  <form method="post" action="options.php">
<?php foreach ($this->option_groups as $option_group): ?>
    <h3><?php echo htmlspecialchars($option_group->name); ?></h3>
    <table class="form-table">
<?php     foreach ($option_group->options as $option): ?>
<?php         $page_options[] = $option->name; ?>
<?php         $this->display_option($option); ?>
<?php     endforeach; ?>
    </table>
<?php endforeach; ?>

    <?php if (function_exists('wp_nonce_field')): wp_nonce_field('update-options'); endif; ?>

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="<?php echo implode(",", $page_options); ?>" />
    <p class="submit">
      <input type="submit" name="Submit" value="Update Options" class="button-primary" />
    </p>
  </form>
<?php
		}

		function display_option($option) {
?>
      <tr valign="top">
        <th scope="row"><label for="<?php echo htmlspecialchars($option->name); ?>"><?php echo htmlspecialchars($option->description); ?></label></th>
        <td>
<?php         $option_value = get_option($option->name); ?>
<?php         if (strpos($option_value, "\n") === false): ?>
          <input type="text" name="<?php echo htmlspecialchars($option->name); ?>" id="<?php echo htmlspecialchars($option->name); ?>" value="<?php echo htmlspecialchars($option_value); ?>" size="40" /><?php echo htmlspecialchars($option->units ? ' ' . $option->units : ''); ?>
<?php         else: ?>
          <textarea name="<?php echo htmlspecialchars($option->name); ?>" id="<?php echo htmlspecialchars($option->name); ?>" rows="10" cols="40"><?php echo htmlspecialchars($option_value); ?></textarea>
<?php         endif; ?>
<?php         if ($option->default_value): ?>

          <br />
          Default is <code><?php echo htmlspecialchars($option->default_value); ?></code>
<?php         endif; ?>
        </td>
      </tr>
<?php
		}
	}
}
?>
