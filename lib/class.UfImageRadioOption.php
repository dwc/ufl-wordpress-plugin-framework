<?php
require_once('class.UfRadioOption.php');

/*
 * An radio button with an associated image for a UF WordPress plugin.
 */
if (! class_exists('UfImageRadioOption')) {
	class UfImageRadioOption extends UfRadioOption {

		function display_label() {
?>
<?php
		}

		function display_value_body($value) {
?>
		  <input type="radio" name="<?php echo htmlspecialchars($this->name); ?>" id="<?php echo htmlspecialchars($this->default_value); ?>" value="<?php echo htmlspecialchars($this->default_value) ?>"<?php if (strcmp($value, $this->default_value) == 0): ?> checked <?php endif; ?> /> <label for="<?php echo htmlspecialchars($this->default_value); ?>"><?php echo htmlspecialchars($this->description); ?> <br />
				<img src="<?php echo htmlspecialchars($this->units); ?>" /></label>
<?php
		}

		function display_value_default() {
?>
<?php
		}
	}
}
?>
