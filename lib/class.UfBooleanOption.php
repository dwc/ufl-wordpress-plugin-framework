<?php
require_once('class.UfOption.php');


/*
 * An boolean (i.e. checkbox) option for a UF WordPress plugin.
 */
if (! class_exists('UfBooleanOption')) {
	class UfBooleanOption extends UfOption {
		function display_value_body($value) {
?>
					<input type="checkbox" name="<?php echo htmlspecialchars($this->name); ?>" id="<?php echo htmlspecialchars($this->name); ?>" value="1"<?php if ($value): ?> checked="checked"<?php endif; ?> />
<?php
		}

		function display_value_default() {
?>
					<br />
					Default is <code><?php echo htmlspecialchars($this->default_value ? 'true' : 'false'); ?></code>
<?php
		}
	}
}
?>
