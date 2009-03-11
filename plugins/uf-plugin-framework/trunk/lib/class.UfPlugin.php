<?php
require_once('class.UfOptionUtilities.php');
require_once('class.UfUtilities.php');


/*
 * A plugin for a UF WordPress site. This class can handle a number of
 * common plugin tasks, such as installation (options and tables),
 * options pages, and management pages.
 */
if (! class_exists('UfPlugin')) {
	class UfPlugin {
		var $name;
		var $plugin_file;
		var $pages = array();
		var $tables;

		function UfPlugin($name, $plugin_file) {
			$this->name = $name;
			$this->plugin_file = $plugin_file;

			$this->add_plugin_hooks();
		}


		/**************************************************************
		 * Methods
		 **************************************************************/

		/*
		 * Attach to WordPress plugin hooks (actions and filters).
		 */
		function add_plugin_hooks() {
			if (isset($_GET['activate']) and $_GET['activate'] == 'true'
			    or isset($_GET['activate-multi']) and $_GET['activate-multi'] == 'true') {
				add_action('init', array(&$this, 'init'));
			}
			register_deactivation_hook($this->plugin_file, array(&$this, 'deactivate'));

			add_action('admin_head', array(&$this, 'admin_head'));
			add_action('admin_menu', array(&$this, 'admin_menu'));
		}

		/*
		 * Return the path to the specified file in this
		 * plugin's directory.
		 */
		function get_plugin_filename($filename) {
			return dirname($this->plugin_file) . "/$filename";
		}

		/*
		 * Return the path to this plugin's management page.
		 */
		function get_plugin_page() {
			return basename(dirname($this->plugin_file)) . '/' . basename($this->plugin_file);
		}

		/*
		 * Ensure the specified directory exists in the
		 * wp-content directory and return the full path.
		 */
		function make_content_directory($directory_name) {
			$path = ABSPATH . "wp-content/$directory_name/";
			if (! wp_mkdir_p($path)) {
				die('Error creating content directory');
			}

			return $path;
		}

		/*
		 * Return the WordPress action name for the specified
		 * plugin's action.
		 */
		function get_action_name($action) {
			return UfUtilities::get_action_name($this->plugin_file, $action);
		}

		/*
		 * Register the specified controller action.
		 */
		function register_action(&$controller, $action_name) {
			$this->_register_action($controller, $action_name, $this->get_action_name($action_name));
		}

		/*
		 * Register the specified controller action with the
		 * WordPress plugin hooks.
		 */
		function register_native_action(&$controller, $action_name) {
			$this->_register_action($controller, $action_name, $action_name);
		}

		/*
		 * Register the specified controller action with the
		 * WordPress plugin hooks.
		 */
		function _register_action(&$controller, $action_name, $callback) {
			if (is_object($controller)) {
				add_action($callback, array(&$controller, "handle_${action_name}_action"));
			}
			else {
				die('Controller must be an object');
			}
		}

		/*
		 * Add a page of the specific type to this plugin.
		 */
		function add_admin_page($page) {
			$this->pages[] = $page;
		}

		/*
		 * Add a table to this plugin. Note that this doesn't
		 * actually add the table to the database; that is
		 * handled on plugin activation.
		 */
		function add_table($table_name, $create_statement) {
			$this->tables[$table_name] = $create_statement;
		}


		/**************************************************************
		 * Callbacks
		 **************************************************************/

		/*
		 * Install this plugin, creating any database tables and
		 * options.
		 */
		function init() {
			if (current_user_can('activate_plugins')) {
				foreach ($this->pages as $page) {
					$options = $page->option_groups;
					if (is_array($options) and count($options) > 0) {
						UfOptionUtilities::add_options($options);
					}
				}

				if ($this->tables) {
					require_once(ABSPATH . 'wp-admin/upgrade-functions.php');

					foreach ($this->tables as $table_name => $sql) {
						maybe_create_table($table_name, $sql);
					}
				}
			}
		}

		/*
		 * Uninstall this plugin. By default, a no-op.
		 */
		function deactivate() {
		}

		/*
		 * Add some CSS for the management pages.
		 */
		function admin_head() {
			$files = array(
				'plugin.css' => '<style type="text/css" media="screen">__DATA__</style>',
				'plugin.js'  => '<script type="text/javascript">__DATA__</script>',
			);

			foreach ($files as $file => $html) {
				$filename = $this->get_plugin_filename($file);
				if (is_readable($filename)) {
					print str_replace('__DATA__', "\n" . trim(file_get_contents($filename)) . "\n", $html) . "\n";
				}
			}
		}

		/*
		 * Add the menu tabs for this plugin.
		 */
		function admin_menu() {
			foreach ($this->pages as $page) {
				$function_name = "add_{$page->type}_page";
				call_user_func($function_name, $page->title, $page->title, $page->capability, $this->plugin_file, array($page, 'display'));
			}
		}
	}
}
?>
