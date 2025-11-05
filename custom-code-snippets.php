<?php
/**
 * Plugin Name: Custom Code Snippets
 * Plugin URI: https://github.com/ibernabel/custom-code-snippets
 * Description: A well-structured plugin for managing custom code snippets and functionality enhancements.
 * Version: 1.0.0
 * Author: Isaac Bernabel
 * Author URI: https://github.com/ibernabel
 * License: MIT
 * Text Domain: custom-code-snippets
 * Domain Path: /languages
 *
 * @package CustomCodeSnippets
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main plugin class using Singleton pattern
 *
 * @since 1.0.0
 */
final class Custom_Code_Snippets {
    
    /**
     * Plugin version
     *
     * @var string
     */
    const VERSION = '1.0.0';
    
    /**
     * The single instance of the class
     *
     * @var Custom_Code_Snippets|null
     */
    private static $instance = null;
    
    /**
     * Plugin directory path
     *
     * @var string
     */
    private $plugin_path;
    
    /**
     * Plugin directory URL
     *
     * @var string
     */
    private $plugin_url;
    
    /**
     * Get the singleton instance
     *
     * @return Custom_Code_Snippets
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct() {
        $this->define_constants();
        $this->init_hooks();
        $this->load_modules();
    }
    
    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}
    
    /**
     * Prevent unserializing of the instance
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
    
    /**
     * Define plugin constants
     *
     * @return void
     */
    private function define_constants() {
        $this->plugin_path = plugin_dir_path(__FILE__);
        $this->plugin_url = plugin_dir_url(__FILE__);
        
        define('CCS_VERSION', self::VERSION);
        define('CCS_PLUGIN_FILE', __FILE__);
        define('CCS_PLUGIN_PATH', $this->plugin_path);
        define('CCS_PLUGIN_URL', $this->plugin_url);
    }
    
    /**
     * Initialize WordPress hooks
     *
     * @return void
     */
    private function init_hooks() {
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        
        add_action('plugins_loaded', array($this, 'load_textdomain'));
    }
    
    /**
     * Load plugin modules
     *
     * @return void
     */
    private function load_modules() {
        // Load Performance module
        require_once $this->plugin_path . 'includes/modules/class-performance.php';
        CCS_Performance::get_instance();
        
        // Add more modules here as needed
        // require_once $this->plugin_path . 'includes/modules/class-security.php';
        // require_once $this->plugin_path . 'includes/modules/class-seo.php';
    }
    
    /**
     * Plugin activation hook
     *
     * @return void
     */
    public function activate() {
        // Add activation logic here
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation hook
     *
     * @return void
     */
    public function deactivate() {
        // Add deactivation logic here
        flush_rewrite_rules();
    }
    
    /**
     * Load plugin text domain for translations
     *
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'custom-code-snippets',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages'
        );
    }
    
    /**
     * Get plugin version
     *
     * @return string
     */
    public function get_version() {
        return self::VERSION;
    }
    
    /**
     * Get plugin path
     *
     * @param string $path Optional. Path relative to plugin directory.
     * @return string
     */
    public function get_plugin_path($path = '') {
        return $this->plugin_path . ltrim($path, '/');
    }
    
    /**
     * Get plugin URL
     *
     * @param string $path Optional. Path relative to plugin URL.
     * @return string
     */
    public function get_plugin_url($path = '') {
        return $this->plugin_url . ltrim($path, '/');
    }
}

/**
 * Initialize the plugin
 *
 * @return Custom_Code_Snippets
 */
function ccs_init() {
    return Custom_Code_Snippets::get_instance();
}

// Start the plugin
ccs_init();