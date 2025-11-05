<?php
/**
 * Performance Module
 *
 * Handles performance-related optimizations and asset loading
 *
 * @package CustomCodeSnippets
 * @subpackage Modules
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Performance optimization class
 *
 * @since 1.0.0
 */
class CCS_Performance {
    
    /**
     * The single instance of the class
     *
     * @var CCS_Performance|null
     */
    private static $instance = null;
    
    /**
     * Get the singleton instance
     *
     * @return CCS_Performance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Private constructor
     */
    private function __construct() {
        $this->init_hooks();
    }
    
    /**
     * Prevent cloning
     */
    private function __clone() {}
    
    /**
     * Prevent unserializing
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
    
    /**
     * Initialize WordPress hooks
     *
     * @return void
     */
    private function init_hooks() {
        // Preload Metform assets
        add_action('wp_enqueue_scripts', array($this, 'preload_metform_assets'), 1);
        
        // Add more performance-related hooks here
        // add_action('wp_enqueue_scripts', array($this, 'optimize_other_plugin'));
    }
    
    /**
     * Preload Metform assets to prevent render delay
     *
     * Forces Metform CSS and JS to load early, preventing the 1-3 second
     * delay when forms appear after page load. Only loads on pages and posts
     * where forms are likely to be used.
     *
     * @since 1.0.0
     * @return void
     */
    public function preload_metform_assets() {
        // Only load on pages and single posts
        if (!is_page() && !is_single()) {
            return;
        }
        
        // Check if Metform is active
        if (!$this->is_metform_active()) {
            return;
        }
        
        // Enqueue Metform styles early
        $this->enqueue_metform_styles();
        
        // Enqueue Metform scripts early
        $this->enqueue_metform_scripts();
    }
    
    /**
     * Check if Metform plugin is active
     *
     * @return bool
     */
    private function is_metform_active() {
        return class_exists('MetForm\Plugin');
    }
    
    /**
     * Enqueue Metform styles
     *
     * @return void
     */
    private function enqueue_metform_styles() {
        // Main UI styles
        if (wp_style_is('metform-ui', 'registered')) {
            wp_enqueue_style('metform-ui');
        }
        
        // Main plugin styles
        if (wp_style_is('metform-style', 'registered')) {
            wp_enqueue_style('metform-style');
        }
    }
    
    /**
     * Enqueue Metform scripts
     *
     * @return void
     */
    private function enqueue_metform_scripts() {
        // Main app script
        if (wp_script_is('metform-app', 'registered')) {
            wp_enqueue_script('metform-app');
        }
    }
    
    /**
     * Example method for future optimizations
     *
     * Add more performance optimization methods here as needed
     *
     * @return void
     */
    public function optimize_other_plugin() {
        // Future optimization code here
    }
}

// Initialize the module
CCS_Performance::get_instance();