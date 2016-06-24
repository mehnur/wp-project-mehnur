<?php
/**
 * Plugin Name: Custom Products Plugin
 * Plugin URI: http://xentora.com
 * Description: Custom products plugin is a test plugin
 * Version: 1.0.0
 * Author: Arif Amir | Mehnur Tahir
 * Author URI: http://xentora.com/
 * Developer: Xentora Solutions
 * Developer URI: http://xentora.com/
 * Copyright:2016 Xentora Solutions.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/*
 *  In this plugin, we will try to implement different wordpress features ,functions and Custom post types
 * */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'CustomProducts' ) ) :
    /**
     * Main CustomProducts Class
     *
     * @class CustomProducts
     * @version	1.0.0
     */
    /**
     * Class CustomProducts
     */
    final class CustomProducts{
        /**
         * CustomProducts version.
         *
         * @var string
         */
        public $version = '1.0.0';

        /**
         * The single instance of the class.
         *
         * @var CustomProducts
         * @since 2.1
         */
        protected static $_instance = null;


        /**
         * Main CustomProducts Instance.
         *
         * Ensures only one instance of CustomProducts is loaded or can be loaded.
         * @return CustomProducts - Main instance.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * CustomProducts Constructor.
         */
        public function __construct() {

            $this->define_constants();
            $this->includes();
            $this->init_hooks();

            do_action( 'custom_products_loaded' );
        }

        /**
         * Hook into actions and filters.
         * @since  1.0.0
         */
        private function init_hooks() {

            add_action( 'init', array( $this, 'init' ), 0 );
        }

        /**
         * Define  Constants.
         */
        private function define_constants() {
            $this->define( 'CP_PLUGIN_FILE', __FILE__ );
            $this->define( 'CP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
            $this->define( 'CP_VERSION', $this->version );
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * Include required core files used in admin and on the frontend.
         */
        public function includes() {

            include_once( 'includes/class-cp-post-types.php' ); // Registers post types
            include_once( 'includes/class-cp-shortcodes.php' ); // Register shortcode
            include_once( 'includes/class-cp-widgets.php' ); // Registers widgets
            include_once( 'admin/class-cp-admin.php' ); // Administration menu for custom tasks

        }

        /**
         * Init CustomProducts when WordPress Initialises.
         */
        public function init() {

        }

        /**
         * Get the plugin url.
         * @return string
         */
        public function plugin_url() {
            return untrailingslashit( plugins_url( '/', __FILE__ ) );
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public function plugin_path() {
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
        }

        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url() {
            return admin_url( 'admin-ajax.php', 'relative' );
        }
    }

endif;


function CP() {
    return CustomProducts::instance();
}

CP();

