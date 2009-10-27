<?php
/*
 * Controller for UF WordPress sites.
 */
if (! class_exists('UfController')) {
	class UfController {
		function UfController() {
		}

		function redirect($url, $query_form) {
			$url_parts = parse_url($url);
			if ($url_parts['query']) {
				$query_parts = array();
				parse_str($url_parts['query'], $query_parts);

				$query_form = array_merge($query_form, $query_parts);
			}

			$url_parts['query'] = $this->_build_query($query_form);
			$url = $this->_glue_url($url_parts);

			wp_redirect($url);
		}

		function _build_query($query_form, $separator = '&') {
			if (function_exists('http_build_query')) {
				return http_build_query($query_form);
			}

			$query_parts = array();
			foreach ((array) $query_form as $key => $value) {
				$query_parts[] = urlencode($key) . '=' . urlencode($value);
			}

			return implode($separator, $query_parts);
		}

		/*
		 * From http://us3.php.net/manual/en/function.parse-url.php#65873
		 */
		function _glue_url($parsed) {
			if (! is_array($parsed)) return false;

			$url = isset($parsed['scheme']) ? $parsed['scheme'].':'.((strtolower($parsed['scheme']) == 'mailto') ? '':'//'): '';
			$url .= isset($parsed['user']) ? $parsed['user'].($parsed['pass']? ':'.$parsed['pass']:'').'@':'';
			$url .= isset($parsed['host']) ? $parsed['host'] : '';
			$url .= isset($parsed['port']) ? ':'.$parsed['port'] : '';
			$url .= isset($parsed['path']) ? $parsed['path'] : '';
			$url .= isset($parsed['query']) ? '?'.$parsed['query'] : '';
			$url .= isset($parsed['fragment']) ? '#'.$parsed['fragment'] : '';

			return $url;
		}
	}
}
?>
