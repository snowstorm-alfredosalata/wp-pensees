<?php
/**
 * Plugin Name:       Pensées
 * Plugin URI:        https://github.com/snowstorm-alfredosalata
 * Description:       A plugin to manage and display short-form reflective posts called pensées, with AJAX navigation and styling.
 * Version:           1.1
 * Author:            Alfredo Salata
 * Author URI:        https://github.com/snowstorm-alfredosalata
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       pensees
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('PENSEES_PATH', plugin_dir_path(__FILE__));

require_once PENSEES_PATH . 'src/pensee_post_type.php';
require_once PENSEES_PATH . 'src/pensee_viewer.php';
require_once PENSEES_PATH . 'src/pensee_ajax.php';

function PENSEES_init() {
    pensees_register_pensee_post_type();
}

add_action( 'init', 'PENSEES_init' );

function PENSEES_load_textdomain() {
    load_plugin_textdomain('pensees', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'PENSEES_load_textdomain');

function PENSEES_enqueue_scripts() {
    wp_enqueue_style(
        'pensees-css',
        plugins_url('css/pensees.css', __FILE__),
        array(),
        '1.1'
    );

    wp_enqueue_style('dashicons'); 

    wp_enqueue_script(
        'pensees-js',
        plugins_url('js/pensees.js', __FILE__),
        array('jquery'),
        '1.1',
        true
    );

    wp_localize_script('pensees-js', 'pensees_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

add_action('wp_enqueue_scripts', 'PENSEES_enqueue_scripts');