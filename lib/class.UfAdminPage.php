<?php
/*
 * An admin page for a UF WordPress plugin.
 */
if (! class_exists('UfAdminPage')) {
	class UfAdminPage {
		var $title;
		var $description;
		var $capability;
		var $type;
		var $types = array('management', 'options', 'theme', 'users', 'dashboard', 'posts', 'media', 'links', 'pages', 'comments');

		function UfAdminPage($title, $description = '', $capability = 'activate_plugins', $type) {
			$this->title = $title;
			$this->description = $description;
			$this->capability = $capability;

			// XXX: Add validation?
			$this->type = $type;
		}

		function display() {
			$this->display_start();
			$this->display_body();
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
</div><!-- .wrap -->
<?php
		}

		function display_body() {
		}

		function submit_button($label, $primary = true, $level_one_padding = "\t\t", $level_two_padding = "\t\t\t") {
?>
<?php echo $level_one_padding; ?><p class="submit">
<?php echo $level_two_padding; ?><input type="submit" value="<?php echo htmlspecialchars($label); ?>"<?php if ($primary): ?> class="button-primary"<?php endif; ?> />
<?php echo $level_one_padding; ?></p><!-- .submit -->
<?php
		}
	}
}
?>
