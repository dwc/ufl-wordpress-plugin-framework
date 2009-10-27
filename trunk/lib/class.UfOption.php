<?php
/*
 * An option for a UF WordPress plugin.
 */
if (! class_exists('UfOption')) {
	class UfOption {
		var $name;
		var $default_value;
		var $description;
		var $units;

		function UfOption($name, $default_value = '', $description = '', $units = '') {
			$this->name = $name;
			$this->default_value = $default_value;
			$this->description = $description;
			$this->units = $units;
		}

		function display() {
			$this->display_start();
			$this->display_label();
			$this->display_value();
			$this->display_end();
		}

		function display_start() {
?>
			<tr valign="top">
<?php
		}

		function display_label() {
?>
				<th scope="row"><label for="<?php echo htmlspecialchars($this->name); ?>"><?php echo htmlspecialchars($this->description); ?></label></th>
<?php
		}

		function display_value() {
			$this->display_value_start();

			$option_value = get_option($this->name);
			$this->display_value_body($option_value);
			$this->display_value_default();

			$this->display_value_end();
		}

		function display_value_start() {
?>
				<td>
<?php
		}

		function display_value_body($value) {
?>
<?php if (strpos($value, "\n") === false): ?>
					<input type="text" name="<?php echo htmlspecialchars($this->name); ?>" id="<?php echo htmlspecialchars($this->name); ?>" value="<?php echo htmlspecialchars($value); ?>" size="40" /><?php echo htmlspecialchars($this->units ? ' ' . $this->units : ''); ?>
<?php else: ?>
					<textarea name="<?php echo htmlspecialchars($this->name); ?>" id="<?php echo htmlspecialchars($this->name); ?>" rows="10" cols="40"><?php echo htmlspecialchars($value); ?></textarea>
<?php endif; ?>
<?php
		}

		function display_value_default() {
			if ($this->default_value) {
?>
					<br />
					Default is <code><?php echo htmlspecialchars($this->default_value); ?></code>
<?php
			}
		}

		function display_value_end() {
?>
				</td>
<?php
		}

		function display_end() {
?>
			</tr>
<?php
		}
	}
}
?>
