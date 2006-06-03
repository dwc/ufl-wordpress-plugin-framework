<?php
/*
 * An options page for a UF WordPress plugin.
 */
if (! class_exists('UfOptionsPage')) {
	class UfOptionsPage {
		var $title;
		var $description;
		var $option_groups;
		var $level;

		function UfOptionsPage($title, $description = '', $option_groups = array(), $level = 8) {
			$this->title = $title;
			$this->description = $description;
			$this->option_groups = $option_groups;
			$this->level = $level;
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
    <fieldset class="options">
      <legend><?php _e($option_group->name); ?></legend>
      <table width="100%" cellspacing="2" cellpadding="5" class="editform">
<?php     foreach ($option_group->options as $option): ?>
<?php     $page_options[] = $option->name; ?>
        <tr>
          <th width="33%" scope="row" valign="top"><label for="<?php echo htmlspecialchars($option->name); ?>"><?php echo htmlspecialchars($option->description); ?></label></th>
          <td><input type="text" name="<?php echo htmlspecialchars($option->name); ?>" id="<?php echo htmlspecialchars($option->name); ?>" value="<?php echo htmlspecialchars(get_settings($option->name)); ?>" size="30" /><?php echo htmlspecialchars($option->units ? ' ' . $option->units : ''); ?></td>
        </tr>
<?php     endforeach; ?>
      </table>
    </fieldset>
<?php endforeach; ?>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="<?php echo implode(",", $page_options); ?>" />
    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options'); ?> &raquo;" />
    </p>
  </form>
<?php
		}
	}
}
?>
