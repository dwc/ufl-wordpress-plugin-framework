<?php
/*
 * Utility functions for a UF WordPress plugin.
 */
if (! class_exists('UfUtilities')) {
	class UfUtilities {
		/*
		 * Simple wrapper around iconv. If the function exists, call it
		 * to convert from the blog's character set (e.g. UTF-8) to the
		 * specified character set (e.g. ISO-8859-1). If the iconv
		 * function does not exist, replace high-byte characters with
		 * the specified character.
		 */
		function convert_charset($string, $to_charset, $replacement = ' ') {
			$output = '';
			if (function_exists('iconv')) {
				$output = iconv(get_bloginfo('charset'), $to_charset, $string);
			}
			else {
				$length = strlen($string);
				for ($i = 0; $i < $length; $i++) {
					$c = ord($string[$i]);
					$output .= (($c > 31 && $c < 127) ? $string[$i] : $replacement);
				}
			}

			return $output;
		}

		/*
		 * Given an iconv character set specification (e.g.
		 * ISO-8859-1//TRANSLIT), return the actual character set.
		 */
		function get_actual_charset($iconv_charset) {
			$parts = explode('//', $iconv_charset);

			return $parts[0];
		}

		/*
		 * Return the WordPress action name for the specified
		 * plugin's action.
		 */
		function get_action_name($plugin, $action) {
			$basename = str_replace('.php', '', strtolower(basename($plugin)));

			return "uf__{$basename}__{$action}";
		}
	}
}
?>
