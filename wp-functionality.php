<?php
/**
 * @package     WPF
 * @copyright   Copyright (c) 2018, William Kracke
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 * @author      Jason Witt <contact@jawittdesigns.com>
 *
 * @wordpress-plugin
 * Plugin Name:       CSS-Tricks Functionality
 * Plugin URI:        https://github.com/jawittdesigns/
 * Description:       Custom functionality plugin for css-tricks.com
 * Version:           1.0.0
 * Author:            Jason Witt
 * Author URI:        http://jawittdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:
 * Domain Path:       /languages
 * 
 * A fork of   https://github.com/chriscoyier/css-tricks-functionality-plugin
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}
if( !class_exists( 'WPF' ) ) {
	class WPF {

		/**
		 * Instance of the class
		 *
		 * @since 1.0.0
		 * @var Instance of WPF class
		 */
		private static $instance;

		/**
		 * Instance of the plugin
		 *
		 * @since 1.0.0
		 * @static
		 * @staticvar array $instance
		 * @return Instance
		 */
		public static function instance() {
			if ( !isset( self::$instance ) && ! ( self::$instance instanceof WPF ) ) {
				self::$instance = new WPF;
				self::$instance->define_constants();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->init = new WPF_Init();
			}
		return self::$instance;
		}

		/**
		 * Define the plugin constants
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function define_constants() {
			// Plugin Version
			if ( ! defined( 'WPF_VERSION' ) ) {
				define( 'WPF_VERSION', '1.0.0' );
			}
			// Prefix
			if ( ! defined( 'WPF_PREFIX' ) ) {
				define( 'WPF_PREFIX', 'wpf_' );
			}
			// Textdomain
			if ( ! defined( 'WPF_TEXTDOMAIN' ) ) {
				define( 'WPF_TEXTDOMAIN', 'wpf' );
			}
			// Plugin Options
			if ( ! defined( 'WPF_OPTIONS' ) ) {
				define( 'WPF_OPTIONS', 'wpf-options' );
			}
			// Plugin Directory
			if ( ! defined( 'WPF_PLUGIN_DIR' ) ) {
				define( 'WPF_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}
			// Plugin URL
			if ( ! defined( 'WPF_PLUGIN_URL' ) ) {
				define( 'WPF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}
			// Plugin Root File
			if ( ! defined( 'WPF_PLUGIN_FILE' ) ) {
				define( 'WPF_PLUGIN_FILE', __FILE__ );
			}
		}

		/**
		 * Load the required files
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			$includes_path = plugin_dir_path( __FILE__ ) . 'includes/';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-register-post-types.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-register-taxonomies.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-remove-admin-bar.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-clean-up-head.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-close-comments.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-custom-feed-link.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-insert-figure.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-rcp-auto-renew.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-long-url-spam.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-remove-jetpack-bar.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-add-mime-types.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-remove-markdown-support.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-add-email-feed.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-increase-postmeta-form-limit.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-limit-users-delete.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-remove-unwanted-assets.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-remove-post-author-url.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-custom-pagi.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-allowed-tags.php';


			require_once WPF_PLUGIN_DIR . 'includes/template-functions.php';
			require_once WPF_PLUGIN_DIR . 'includes/class-wpf-init.php';
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function load_textdomain() {
			$wpf_lang_dir = dirname( plugin_basename( WPF_PLUGIN_FILE ) ) . '/languages/';
			$wpf_lang_dir = apply_filters( 'WPF_lang_dir', $wpf_lang_dir );

			$locale = apply_filters( 'plugin_locale',  get_locale(), WPF_TEXTDOMAIN );
			$mofile = sprintf( '%1$s-%2$s.mo', WPF_TEXTDOMAIN, $locale );

			$mofile_local  = $wpf_lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/edd/' . $mofile;

			if ( file_exists( $mofile_local ) ) {
				load_textdomain( WPF_TEXTDOMAIN, $mofile_local );
			} else {
				load_plugin_textdomain( WPF_TEXTDOMAIN, false, $wpf_lang_dir );
			}
		}

		/**
		 * Throw error on object clone
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', WPF_TEXTDOMAIN ), '1.6' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', WPF_TEXTDOMAIN ), '1.6' );
		}

	}
}
/**
 * Return the instance
 *
 * @since 1.0.0
 * @return object The Safety Links instance
 */
function WPF_Run() {
	return WPF::instance();
}
WPF_Run();
