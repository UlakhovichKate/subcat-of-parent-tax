<?php

/*
Plugin Name: Subcategories of Parent Terms
Plugin URI:
Description: Grid of subcategories of all parent terms of a custom taxonomy
Version: 1.0.0
Author: Katsiaryna Ulakhovich
Author URI: https://github.com/UlakhovichKate
License: GPLv2 or later
Text Domain: subcat-of-parent-tax-plugin
*/

defined( 'ABSPATH' ) || exit;

if(!class_exists('SubcatOfTax') ) {

    class SubcatOfTax {

        function register() {

            require_once plugin_dir_path(__FILE__) . 'includes/getSubcategories.php';
            $this->add_actions();

        }

        static function add_actions() {
            add_action( 'wp_enqueue_scripts',  [__CLASS__, 'enqueue_styles'] );
        }

        static function enqueue_styles() {
            wp_enqueue_style( 'subcat-of-tax-styles',  plugin_dir_url( __FILE__ ) . 'style.css' );
        }
    }

    $plugin = new SubcatOfTax();
    $plugin->register();
}
