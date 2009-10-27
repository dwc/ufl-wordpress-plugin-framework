<?php
if (! class_exists('UfTemplate')) {
	class UfTemplate {
		function fill($filename, &$vars) {
			extract($vars);

			ob_start();
			include($filename);
			return ob_get_clean();
		}
	}
}
?>
