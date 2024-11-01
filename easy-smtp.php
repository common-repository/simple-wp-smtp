<?php
/**
 * Plugin Name: Simple WP SMTP
 * Plugin URI: #
 * Description: Send the email form wordpress using SMTP
 * Version: 1.0.0
 * Author: MageINIC
 * Author URI: https://profiles.wordpress.org/wpteamindianic/#content-plugins
 * Text Domain: simple-wp-smtp
 * Domain Path: languages/
 * Requires at least: 5.8
 * Requires PHP: 7.2
 *
 * @package simple-wp-smtp
 */

defined( 'ABSPATH' ) || exit;
define('SIMPLE_WP_SMTP_URL', plugin_dir_url(__FILE__));
define('SIMPLE_WP_SMTP_PUBLIC_URL', SIMPLE_WP_SMTP_URL . 'public/');

/**
 * Init Hook for plugin
 * @since 1.0
 * */
add_action( 'init', 'simple_wp_smtp_init' );
function simple_wp_smtp_init() {
    include_once plugin_dir_path( __FILE__ ).'admin/admin-menu.php';
    include_once plugin_dir_path( __FILE__ ).'inc/helper-function.php';
}
/**
 * Activation Hook
 * @since 1.0
 * */
register_activation_hook( __FILE__, 'simple_wp_smtp_flush_rewrites' );
function simple_wp_smtp_flush_rewrites() {
        //activate_simple_wp_smtp();
}
/**
 * Uninstall Hook
 * @since 1.0
 * */
register_uninstall_hook( __FILE__, 'simple_wp_smtp_uninstall' );
function simple_wp_smtp_uninstall() {
  // Uninstallation stuff here
}
/**
 * Add CSS and JS to Admin side
 * @since 1.0
 * */
function simple_wp_smtp_add_admin_jscss(){
    $screen = get_current_screen();
    $test_mail_screen = 'smtp-settings_page_smtp_test_mail';
    $mail_settings_screen = 'toplevel_page_smtp_settings';
    if( is_object( $screen ) && (($test_mail_screen == $screen->base) || ($mail_settings_screen == $screen->base)) ) {
        wp_enqueue_style('simple-wp-smtp-open-props',SIMPLE_WP_SMTP_URL . '/admin/css/open-props.css');
        wp_enqueue_style('simple-wp-smtpforms',SIMPLE_WP_SMTP_URL . '/admin/css/forms.css');
    }
    /*if( is_object( $screen ) && 'simple_wp_smtp' == $screen->post_type ){
        wp_enqueue_script( 'simple_wp_smtp_adminjs',SIMPLE_WP_SMTP_PUBLIC_URL . '/assets/js/wp-joblistingadmin.js', array('jquery'));
    }*/
}
add_action('admin_enqueue_scripts','simple_wp_smtp_add_admin_jscss');