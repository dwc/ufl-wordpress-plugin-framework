<?php
// For wp_generate_attachment_metadata
require_once(ABSPATH . 'wp-admin/includes/image.php');


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

		/*
		 * Inject an attachment into WordPress, by copying an
		 * existing file and simulating all the work that
		 * WordPress does (in wp_handle_upload) on file upload
		 * but doesn't have refactored.
		 */
		function inject_attachment($attachment, $file) {
			$uploads = wp_upload_dir($attachment['post_date']);
			if ($uploads['error']) die("Couldn't get upload directory.");
			//echo "uploads = "; print_r($uploads); ob_flush(); flush();

			$filename = wp_unique_filename($uploads['path'], basename($file));
			$new_file = $uploads['path'] . '/' . $filename;
			if (! copy($file, $new_file)) die("Couldn't copy file $file to $new_file.");
			//echo "copied file = [$file] to new_file = [$new_file]\n"; ob_flush(); flush();

			$stat = stat(dirname($new_file));
			$perms = $stat['mode'] & 0000666;
			chmod($new_file, $perms);
			//echo "chmod'd new_file = [$new_file] to perms = [$perms]\n"; ob_flush(); flush();

			$url = $uploads['url'] . '/' . $filename;
			//echo "url = [$url]\n"; ob_flush(); flush();

			$size = getimagesize($new_file);
			//echo "size = "; print_r($size); ob_flush(); flush();
			apply_filters('wp_handle_upload', array('file' => $new_file, 'url' => $url, 'type' => $size['mime']));
			//echo "applied wp_handle_upload filters\n"; ob_flush(); flush();

			// Now, add the attachment
			$attachment['guid'] = $url;
			$attachment['post_mime_type'] = $size['mime'];

			$attachment_id = wp_insert_attachment($attachment, $new_file);
			//echo "inserted attachment_id = [$attachment_id]\n"; ob_flush(); flush();
			if (! is_wp_error($attachment_id)) {
				wp_update_attachment_metadata($attachment_id, wp_generate_attachment_metadata($attachment_id, $new_file));
				//echo "generated metadata for attachment_id = [$attachment_id]\n"; ob_flush(); flush();
			}

			return $attachment_id;
		}
	}
}
?>
